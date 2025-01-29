@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">IT H/W Work Order Request Form</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('user.tickets.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="ticket_type" value="hardware"> 

            <!-- Requester Information -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Order ID</label>
                    <input type="text" value="Auto number" readonly class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Request Date</label>
                    <input type="date" name="request_date" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ now()->format('Y-m-d') }}">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Organization</label>
                    <input type="text" name="organization" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Requester</label>
                    <input type="text" name="requester" value="{{ Auth::user()->name }}" readonly class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100">
                </div>
            </div>

            <!-- Infrastructure Selection -->
            <div>
                <label class="block font-medium text-gray-700">Infrastructure *</label>
                <select name="infrastructure" id="infrastructure" class="w-full p-2 border border-gray-300 rounded-lg" onchange="updateHardwareList()">
                    <option value="">Pilih Infrastruktur</option>
                    <option value="Peripheral">Peripheral</option>
                    <option value="Server">Server</option>
                    <option value="Internet">Internet</option>
                </select>
            </div>

            <!-- Hardware Selection -->
            <div>
                <label class="block font-medium text-gray-700">Hardware *</label>
                <select name="hardware" id="hardware" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">Pilih Hardware</option>
                </select>
            </div>

            <!-- H/W WO Type -->
            <div>
                <label class="block font-medium text-gray-700">H/W WO Type *</label>
                <select name="wo_type" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="Problem">Problem</option>
                    <option value="Damage">Damage</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Others">Others</option>
                </select>
            </div>

                        <!-- Scope -->
                        <div>
                            <label class="block font-medium text-gray-700">Scope</label>
                            <textarea name="scope" class="w-full p-2 border border-gray-300 rounded-lg h-20"></textarea>
                        </div>


            <!-- Description -->
            <div>
                <label class="block font-medium text-gray-700">Detail Description *</label>
                <textarea name="description" class="w-full p-2 border border-gray-300 rounded-lg h-32"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4">
                <button type="submit" class="w-1/2 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Submit
                </button>
                <button type="reset" class="w-1/2 bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-500">
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const hardwareOptions = {
        "Peripheral": ["Computer000", "Printer", "FAX", "Scanner", "Telephone", "Modem", "Others"],
        "Server": ["Email Server", "SAP Server", "Web Server"],
        "Internet": ["-"]
    };

    function updateHardwareList() {
        let infrastructure = document.getElementById("infrastructure").value;
        let hardwareSelect = document.getElementById("hardware");
        hardwareSelect.innerHTML = "<option value=''>Pilih Hardware</option>";

        if (hardwareOptions[infrastructure]) {
            hardwareOptions[infrastructure].forEach(hardware => {
                let option = document.createElement("option");
                option.value = hardware;
                option.textContent = hardware;
                hardwareSelect.appendChild(option);
            });
        }
    }
</script>
@endsection
