<x-layout>
    <section class="mx-auto w-auto">
        <x-clients.card-horizontal :$client />
        <x-forms.form
            class="hidden"
            method="POST"
            verb="DELETE"
            action="/clients/{{ $client->id }}"
            id="delete-client-form">
            <button type="submit">
                Delete
            </button>
        </x-forms.form>
        <div class="max-w-4xl mt-5 mx-auto">
            <x-clients.tabs-horizontal :$client />
        </div>
    </section>

    <x-slot:script>
        <script>
            const deleteClient = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this client?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#delete-client-form button`).click();
                }
            }

            const deleteVehicle = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this vehicle?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#delete-vehicle-${id}-form button`).click();
                }
            }

        </script>
    </x-slot>
</x-layout>
