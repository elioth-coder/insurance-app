<?php
// app/Services/OrNumberGenerator.php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrNumberGenerator
{
    public function generate(string $branchCode='000001'): string
    {
        // Use a transaction to safely handle concurrent updates
        $sequence = DB::transaction(function () use ($branchCode) {
            // Find or create the branch-specific sequence row
            $sequenceRow = DB::table('or_sequences')
                ->where('branch_code', $branchCode)
                ->lockForUpdate()
                ->first();

            $today = Carbon::now()->toDateString(); // Current date in 'YYYY-MM-DD' format

            if (!$sequenceRow) {
                DB::table('or_sequences')->insert([
                    'branch_code' => $branchCode,
                    'last_sequence' => 1,
                    'last_reset_date' => $today,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $newSequence = 1;
            } else {
                // Check if the sequence was last reset today; if not, reset it
                if ($sequenceRow->last_reset_date !== $today) {
                    // Reset the sequence to 1 if today is a new day
                    $newSequence = 1;
                    DB::table('or_sequences')
                        ->where('branch_code', $branchCode)
                        ->update([
                            'last_sequence' => $newSequence,
                            'last_reset_date' => $today,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Increment the existing sequence number
                    $newSequence = $sequenceRow->last_sequence + 1;
                    DB::table('or_sequences')
                        ->where('branch_code', $branchCode)
                        ->update(['last_sequence' => $newSequence]);
                }
            }

            return $newSequence;
        });

        // Generate the OR number using the current timestamp, branch code, and sequence
        $timestamp = Carbon::now()->format('Ymd-His');
        $orNumber = $timestamp . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return $orNumber;
    }
}
