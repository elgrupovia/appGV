@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Nombre de Empresa -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nombre de Empresa</label>
        <input type="text" name="name" id="name" value="{{ old('name', $company->name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Sector -->
    <div>
        <label for="sector" class="block text-sm font-medium text-gray-700">Sector</label>
        <input type="text" name="sector" id="sector" value="{{ old('sector', $company->sector ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('sector') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Contacto -->
    <div>
        <label for="contact" class="block text-sm font-medium text-gray-700">Contacto</label>
        <input type="text" name="contact" id="contact" value="{{ old('contact', $company->contact ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Teléfono -->
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $company->phone ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $company->email ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Web -->
    <div>
        <label for="website" class="block text-sm font-medium text-gray-700">Sitio Web</label>
        <input type="url" name="website" id="website" value="{{ old('website', $company->website ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Logo -->
    <div>
        <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
        <input type="file" name="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        @if(isset($company) && $company->logo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo actual" class="h-20">
            </div>
        @endif
        @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Dirección -->
    <div class="md:col-span-2">
        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
        <input type="text" name="address" id="address" value="{{ old('address', $company->address ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Ciudad -->
    <div>
        <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
        <input type="text" name="city" id="city" value="{{ old('city', $company->city ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Provincia -->
    <div>
        <label for="province" class="block text-sm font-medium text-gray-700">Provincia</label>
        <input type="text" name="province" id="province" value="{{ old('province', $company->province ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div>

<div class="flex justify-end mt-6">
    <a href="{{ route('companies.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
        Cancelar
    </a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ $submitButtonText ?? 'Guardar' }}
    </button>
</div>