@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">IT S/W Work Order Request Form</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('user.tickets.store') }}" enctype="multipart/form-data" class="space-y-4" id="ticketForm">
            @csrf

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

            <!-- System Selection -->
            <div>
                <label class="block font-medium text-gray-700">System *</label>
                <select name="system" id="system" class="w-full p-2 border border-gray-300 rounded-lg" onchange="updateSubSystem()">
                    <option value="">Pilih System</option>
                    <option value="SAP">SAP</option>
                    <option value="SAP Report">SAP Report</option>
                    <option value="PAYROLL">PAYROLL</option>
                    <option value="DDIS">DDIS</option>
                    <option value="OPEX">OPEX</option>
                    <option value="MSF">MSF</option>
                </select>
            </div>

            <!-- Sub-System Selection -->
            <div>
                <label class="block font-medium text-gray-700">Sub-System *</label>
                <select name="sub_system" id="sub_system" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">Pilih Sub-System</option>
                </select>
            </div>

            <!-- S/W WO Type -->
            <div>
                <label class="block font-medium text-gray-700">S/W WO Type *</label>
                <select name="wo_type" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="Modification">Modification</option>
                    <option value="Problem">Problem</option>
                    <option value="Enhancement">Enhancement</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <!-- Scope -->
            <div>
                <label class="block font-medium text-gray-700">Scope</label>
                <textarea name="scope" class="w-full p-2 border border-gray-300 rounded-lg h-20"></textarea>
            </div>

            <!-- Detail Description -->
            <div>
                <label class="block font-medium text-gray-700">Detail Description *</label>
                <textarea name="description" class="w-full p-2 border border-gray-300 rounded-lg h-32"></textarea>
            </div>

            <!-- Input File -->
            <div>
                <label class="block font-medium text-gray-700">Lampiran (Optional)</label>
                <input type="file" name="attachment" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Input Link -->
            <div>
                <label class="block font-medium text-gray-700">Link (Optional)</label>
                <input type="url" name="link" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>


            <!-- Buttons -->
            <div class="flex space-x-4">
                <button type="button" class="w-1/2 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700" id="openModal">
                    Submit
                </button>
                <button type="reset" class="w-1/2 bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-500">
                    Reset
                </button>
            </div>
        </form>
        <!-- 🔥 Popup Modal -->
<div id="confirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 text-center">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Pengiriman</h2>
        <p>Apakah Anda yakin ingin mengirim tiket ini?</p>
        <div class="mt-6 flex justify-center space-x-4">
            <button id="confirmSubmit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Ya, Kirim</button>
            <button id="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</button>
        </div>
    </div>
</div>
    </div>
</div>

<script>
    const subSystems = {
        "SAP": [
            "Material Management (MM) - Purchasing",
            "Material Management (MM) - Material Master",
            "Material Management (MM) - Goods Movement",
            "Sales Distribution - Sales Order",
            "Sales Distribution - Master Data",
            "Production Planning - Master Data",
            "Production Planning - Processing",
            "Plant Maintenance (PM) - 1040 Order"
        ],
        "SAP Report": ["All Module"],
        "PAYROLL": ["Module"],
        "DDIS": ["Sales"],
        "OPEX": ["Sales"],
        "MSF": ["Sales"]
    };

    function updateSubSystem() {
        let system = document.getElementById("system").value;
        let subSystemSelect = document.getElementById("sub_system");
        subSystemSelect.innerHTML = "<option value=''>Pilih Sub-System</option>";

        if (subSystems[system]) {
            subSystems[system].forEach(sub => {
                let option = document.createElement("option");
                option.value = sub;
                option.textContent = sub;
                subSystemSelect.appendChild(option);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Tombol untuk membuka modal
        document.getElementById('openModal').addEventListener('click', function() {
            console.log("Tombol Submit ditekan!"); // 🔥 Debugging
            document.getElementById('confirmModal').classList.remove('hidden');
        });

        // Tombol untuk menutup modal tanpa mengirim form
        document.getElementById('closeModal').addEventListener('click', function() {
            console.log("Popup ditutup!");
            document.getElementById('confirmModal').classList.add('hidden');
        });

        // Tombol untuk mengirim form
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            console.log("Tiket dikirim!");
            document.getElementById('ticketForm').submit(); // 🔥 Kirim form
        });
    });
</script>
@endsection
