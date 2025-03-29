<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Lista de Usuarios</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Email Verificado</th>
                                        <th>Foto de Perfil</th>
                                        <th>Equipo Actual</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->email_verified_at ? date('d/m/Y H:i', strtotime($user->email_verified_at)) : 'No verificado' }}</td>
                                        <td>
                                            @if($user->profile_photo_path)
                                            <img src="{{ Storage::url($user->profile_photo_path) }}" alt="Foto de perfil" class="rounded-circle" width="50">
                                            @else
                                            Sin foto
                                            @endif
                                        </td>
                                        <td>{{ $user->current_team_id ?? 'Sin equipo' }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($user->updated_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>