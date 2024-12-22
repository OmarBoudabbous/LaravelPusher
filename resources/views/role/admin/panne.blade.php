@extends('role.admin.index')
@section('content')
    <div class="row justify-content-center">
        {{-- ajouter Panne --}}
        <div class="col-lg-6 col-xl-6 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-4">Ajouter Panne</h6>
                    </div>
                    <form id="panneForm" action="{{ route('panne.store') }}" method="POST">
                        @csrf
                        @method('POST')
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
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         {{-- Liste des Pannes --}}
        <div class="col-lg-6 col-xl-6 stretch-card">
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
                                @foreach ($userPannes as $panne)
                                    <tr>
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
                        <div class='mt-2'>
                            {{ $userPannes->links('pagination::simple-bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    
@endsection
