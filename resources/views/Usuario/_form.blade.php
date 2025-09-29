@php
    // Para edición, $usuario llega definido; en creación es null.
    $val = fn($key, $default = '') => old($key, isset($usuario) ? ($usuario->{$key} ?? $default) : $default);
@endphp

<div class="space-y-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Número de Documento *</label>
            <input type="text" name="numero_documento" value="{{ $val('numero_documento') }}"
                   class="w-full border rounded px-3 py-2" required>
            @error('numero_documento')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Nombre *</label>
            <input type="text" name="nombre" value="{{ $val('nombre') }}"
                   class="w-full border rounded px-3 py-2" required>
            @error('nombre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Apellido *</label>
            <input type="text" name="apellido" value="{{ $val('apellido') }}"
                   class="w-full border rounded px-3 py-2" required>
            @error('apellido')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Correo *</label>
        <input type="email" name="email" value="{{ $val('email') }}"
               class="w-full border rounded px-3 py-2" required>
        @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Contraseña *</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
            @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Confirmar Contraseña *</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Rol *</label>
            <select name="rol_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Selecciona --</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->rol_id }}" @selected($val('rol_id') == $rol->rol_id)>
                        {{ $rol->nombre_rol }}
                    </option>
                @endforeach
            </select>
            @error('rol_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Sede *</label>
            <select name="sede_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Selecciona --</option>
                @foreach($sedes as $sede)
                    <option value="{{ $sede->sede_id }}" @selected($val('sede_id') == $sede->sede_id)>
                        {{ $sede->nombre_sede }}
                    </option>
                @endforeach
            </select>
            @error('sede_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Jornada *</label>
            <select name="jornada_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Selecciona --</option>
                @foreach($jornadas as $jornada)
                    <option value="{{ $jornada->jornada_id }}" @selected($val('jornada_id') == $jornada->jornada_id)>
                        {{ $jornada->nombre_jornada }}
                    </option>
                @endforeach
            </select>
            @error('jornada_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ficha *</label>
            <select name="ficha_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Selecciona --</option>
                @foreach($fichas as $ficha)
                    <option value="{{ $ficha->ficha_id }}" @selected($val('ficha_id') == $ficha->ficha_id)>
                        {{ $ficha->nombre_ficha }}
                    </option>
                @endforeach
            </select>
            @error('ficha_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label class="flex items-center">
            <input type="checkbox" name="activo" value="1" @checked($val('activo', 1))>
            <span class="ml-2 text-sm">Activo</span>
        </label>
    </div>

</div>