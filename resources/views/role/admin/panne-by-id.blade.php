@extends('role.admin.index')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- card for one panne --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-8 stretch-card ">
            <div
                class="card border border-primary  @if ($panne->status === 'Annulée') border-danger
                                        @elseif($panne->status === 'En cours') border-warning
                                        @elseif($panne->status === 'Terminée') border-success
                                        @else 
                                            border-secondary @endif">
                <div class="card-header bg-transparent border-primary ">
                    <h5
                        class="my-0   @if ($panne->status === 'Annulée') text-danger
                                        @elseif($panne->status === 'En cours') text-warning
                                        @elseif($panne->status === 'Terminée') text-success
                                        @else 
                                            text-secondary @endif">
                        <i class="mdi mdi-bullseye-arrow me-3"></i>Panne Numéro {{ $panne->id }}
                    </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Type de Panne : {{ $panne->type }}</h5>
                    <p class="card-text">Status :
                        <span
                            class="badge 
                                @if ($panne->status === 'Annulée') bg-danger
                                @elseif($panne->status === 'En cours') bg-warning
                                @elseif($panne->status === 'Terminée') bg-success
                                @else 
                                    bg-secondary @endif">
                            {{ $panne->status }}
                        </span>
                    <p class="card-text">Voie Numéro : <strong>{{ $panne->voie }}</strong></p>
                    <p class="card-text">Receveur : <strong>{{ $panne->user->name }}</strong>
                        <span style="margin-left: 14px">Matricule :<strong>{{ $panne->user->matricule }}</strong></span>
                    </p>
                    <p class="card-text">Déscription : <strong>{{ $panne->comment }}</strong></p>

                    <div class="d-flex justify-content-center align-items-center gap-3">

                        {{-- buuton delete panne --}}
                        <form action="{{ route('admin.panne.destroy', $panne->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette panne ??')">
                                <i class="fas fa-trash-alt align-middle p-2"></i>
                            </button>
                        </form>

                        {{-- button update panne --}}
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" data-id="{{ $panne->id }}"
                            data-user="{{ $panne->user->id }}" data-voie="{{ $panne->voie }}"
                            data-type="{{ $panne->type }}" data-status="{{ $panne->status }}"
                            data-comment="{{ $panne->comment }}">
                            <i class="fas fa-edit align-middle p-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Panne</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="panneForm" action="{{ route('admin.panne.update', $panne->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user-id" class="form-label">User ID</label>
                            <input type="text" id="user-id" name="user_id" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="panne-id" class="form-label">Panne ID</label>
                            <input type="text" id="panne-id" name="id" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="panne-voie" class="form-label">Voie</label>
                            <select id="panne-voie" class="form-select" name="voie">
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="E4">E4</option>
                                <option value="E5">E5</option>
                                <option value="E6">E6</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="panne-type" class="form-label">Type</label>
                            <select id="panne-type" class="form-select" name="type">
                                <option value="LECTURE">LECTURE</option>
                                <option value="PANNE_ELECTRICITE">PANNE ELECTRICITE</option>
                                <option value="BARRIERE">BARRIERE</option>
                                <option value="CLASSE">CLASSE</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="panne-status" class="form-label">Status</label>
                            <select id="panne-status" class="form-select" name="status">
                                <option value="En cours">En cours</option>
                                <option value="Terminée">Terminée</option>
                                <option value="Annulée">Annulée</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="panne-comment" class="form-label">Comment</label>
                            <textarea id="panne-comment" class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- table for list panne --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-4">Liste des Pannes</h6>
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
                                @foreach ($pannes as $panne)
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
                    <div class="mt-3">
                        {{ $pannes->appends(request()->except('pannes_page'))->links('pagination::simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


         {{-- script for the modal --}}
         <script>
            document.addEventListener('DOMContentLoaded', () => {
                const staticBackdrop = document.getElementById('staticBackdrop');
                staticBackdrop.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
    
                    // Extract data attributes
                    const user = button.getAttribute('data-user');
                    const id = button.getAttribute('data-id');
                    const voie = button.getAttribute('data-voie');
                    const type = button.getAttribute('data-type');
                    const status = button.getAttribute('data-status');
                    const comment = button.getAttribute('data-comment');
    
                    // Populate modal fields
                    document.getElementById('user-id').value = user;
                    document.getElementById('panne-id').value = id;
                    document.getElementById('panne-voie').value = voie;
                    document.getElementById('panne-type').value = type;
                    document.getElementById('panne-status').value = status;
                    document.getElementById('panne-comment').value = comment;
                });
            });
        </script>
@endsection
