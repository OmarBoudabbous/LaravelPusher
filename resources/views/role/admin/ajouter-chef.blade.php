@extends('role.admin.index')
@section('content')
    <div class="row">

        {{-- List for add users --}}
        <div class="col-lg-5 col-xl-8 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-4">Ajouter un Chef</h6>
                    </div>
                    <form action="{{ route('admin.chef.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="form-select @error('role') is-invalid @enderror" name="role">
                            <option value="chef" {{ old('role') == 'chef' ? 'selected' : '' }}>Chef</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="matricule">Matricule</label>
                            <input type="text" class="form-control @error('matricule') is-invalid @enderror"
                                id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                            @error('matricule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de Passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le Mot de Passe</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>


        {{-- list for users   --}}
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-4">List Receveurs</h6>

                    </div>
                    <hr>
                    <div class="table-responsive">

                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0"><strong> Name </strong></th>
                                    <th class="pt-0"><strong>Matricule</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr onclick="window.location='{{ route('chef.data', $user->id) }}'"
                                        style="cursor: pointer;">

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->matricule }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $users->appends(request()->except('users_page'))->links('pagination::simple-bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
