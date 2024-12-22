@extends('role.admin.index')
@section('content')
    <div class="row">

        {{-- List for USers --}}
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
                                    <th class="pt-0">Name</th>
                                    <th class="pt-0">Matricule</th>
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
                            {{ $users->appends(request()->except('page'))->links('pagination::simple-bootstrap-4') }}
                            <p>Page {{ $users->currentPage() }} of {{ $users->lastPage() }} Page for total users
                                {{ $users->total() }} </p>
                                 <ul class="pagination pagination-rounded">
                                    @if ($users->onFirstPage())
                                        <li class="paginate_button page-item previous disabled" id="selection-datatable_previous">
                                            <a href="#" aria-controls="selection-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item previous" id="selection-datatable_previous">
                                            <a href="{{ $users->previousPageUrl() }}" aria-controls="selection-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="paginate_button page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                            <a href="{{ $url }}" aria-controls="selection-datatable" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    @if ($users->hasMorePages())
                                        <li class="paginate_button page-item next" id="selection-datatable_next">
                                            <a href="{{ $users->nextPageUrl() }}" aria-controls="selection-datatable" data-dt-idx="{{ $users->lastPage() }}" tabindex="0" class="page-link">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item next disabled" id="selection-datatable_next">
                                            <a href="#" aria-controls="selection-datatable" data-dt-idx="{{ $users->lastPage() }}" tabindex="0" class="page-link">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAble for Pannes --}}
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
    </div> <!-- row -->
@endsection
