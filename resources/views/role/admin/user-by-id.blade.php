@extends('role.admin.index')
@section('content')
    <div class="row">
        
        <div class="col-lg-4">
            <div class="card border border-success">
                <div class="d-flex justify-content-center align-items-center">
                    <img class="avatar-md rounded-circle"
                        src="{{ !empty($profileData->photo) ? url('images/' . $profileData->photo) : url('images/no_image.jpeg') }}"
                        alt="Header Avatar">
                </div>
                <div class="card-header bg-transparent border-success ">

                    <h5 class="my-0">
                        <i class="mdi mdi-bullseye-arrow me-3"></i>Name : {{ $user->name }}
                    </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Matricule : {{ $user->matricule }}</h5>
                    <p class="card-text">Receveur : <strong>{{ $user->name }}</strong>
                    </p>

                </div>

            </div>
        </div>

        {{-- TAble for Pannes --}}
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-4">Panne</h6>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Voie</th>
                                    <th class="pt-0">Type</th>
                                    <th class="pt-0">Date Creation</th>
                                    <th class="pt-0">Matricule</th>
                                    <th class="pt-0">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->pannes as $panne)
                                    <tr onclick="window.location='{{ route('admin.panne', $panne->id) }}'"
                                        style="cursor: pointer;">

                                        <td>{{ $panne->id }}</td>
                                        <td>{{ $panne->voie }}</td>
                                        <td>{{ $panne->type }}</td>
                                        <td>{{ $panne->created_at }}</td>
                                        <td>{{ $panne->user->matricule }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                            @if ($panne->status === 'Annulée') bg-danger
                                            @elseif($panne->status === 'En cours') bg-warning
                                            @elseif($panne->status === 'Terminée') bg-success
                                            @else 
                                                bg-secondary @endif">
                                                {{ $panne->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
