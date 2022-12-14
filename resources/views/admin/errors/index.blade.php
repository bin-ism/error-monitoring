@php
use App\Http\Helper\Url;
@endphp
@extends('admin.layouts.app')

@section('body')
    @if (Session::has('message'))
        <div class="toast-container position-absolute p-3 top-0 end-0" id="toastPlacement"
            data-original-class="toast-container position-absolute p-3">
            <div class="toast fade show">
                <div class="toast-header">
                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <rect width="100%" height="100%" fill="green"></rect>
                    </svg>
                </div>
                <div class="toast-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    @if ($errors->isNotEmpty())
        <div class="mb-3 d-flex justify-content-around">
            <div>
                <button class="btn btn-danger" id="group-delete">delete</button>
            </div>
            <div>
                <input type="checkbox" id="select-all">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                    <tr class="align-middle">
                        <th>Errors</th>
                        <th><a href="{{ Url::addParamToEndOfUrl('sort_errorsCount', $sort['errorCount']) }}">Errors
                                Count</a></th>
                        <th><a href="{{ Url::addParamToEndOfUrl('sort_language', $sort['sort_language']) }}">Language</a>
                        </th>
                        <th>Language</th>
                        <th>Delete</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($errors as $error)
                        <tr class="align-middle">
                            <td>
                                <div><a href="{{ route('errors.show', $error->id) }}">{{ $error->message }}</a>
                                </div>
                            </td>
                            <td>
                                @if ($error->errorsCount)
                                    <button type="button"
                                        class="btn btn-primary rounded-pill">{{ $error->errorsCount }}</button>
                                @endif
                            </td>
                            <td>
                                {{ $error->language }}
                            </td>
                            <td>
                                <form action="{{ route('errors.destroy', $error->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button>
                                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                            width="50px" height="50px">
                                            <path
                                                d="M 21 0 C 19.355469 0 18 1.355469 18 3 L 18 5 L 10.1875 5 C 10.0625 4.976563 9.9375 4.976563 9.8125 5 L 8 5 C 7.96875 5 7.9375 5 7.90625 5 C 7.355469 5.027344 6.925781 5.496094 6.953125 6.046875 C 6.980469 6.597656 7.449219 7.027344 8 7 L 9.09375 7 L 12.6875 47.5 C 12.8125 48.898438 14.003906 50 15.40625 50 L 34.59375 50 C 35.996094 50 37.1875 48.898438 37.3125 47.5 L 40.90625 7 L 42 7 C 42.359375 7.003906 42.695313 6.816406 42.878906 6.503906 C 43.058594 6.191406 43.058594 5.808594 42.878906 5.496094 C 42.695313 5.183594 42.359375 4.996094 42 5 L 32 5 L 32 3 C 32 1.355469 30.644531 0 29 0 Z M 21 2 L 29 2 C 29.5625 2 30 2.4375 30 3 L 30 5 L 20 5 L 20 3 C 20 2.4375 20.4375 2 21 2 Z M 11.09375 7 L 38.90625 7 L 35.3125 47.34375 C 35.28125 47.691406 34.910156 48 34.59375 48 L 15.40625 48 C 15.089844 48 14.71875 47.691406 14.6875 47.34375 Z M 18.90625 9.96875 C 18.863281 9.976563 18.820313 9.988281 18.78125 10 C 18.316406 10.105469 17.988281 10.523438 18 11 L 18 44 C 17.996094 44.359375 18.183594 44.695313 18.496094 44.878906 C 18.808594 45.058594 19.191406 45.058594 19.503906 44.878906 C 19.816406 44.695313 20.003906 44.359375 20 44 L 20 11 C 20.011719 10.710938 19.894531 10.433594 19.6875 10.238281 C 19.476563 10.039063 19.191406 9.941406 18.90625 9.96875 Z M 24.90625 9.96875 C 24.863281 9.976563 24.820313 9.988281 24.78125 10 C 24.316406 10.105469 23.988281 10.523438 24 11 L 24 44 C 23.996094 44.359375 24.183594 44.695313 24.496094 44.878906 C 24.808594 45.058594 25.191406 45.058594 25.503906 44.878906 C 25.816406 44.695313 26.003906 44.359375 26 44 L 26 11 C 26.011719 10.710938 25.894531 10.433594 25.6875 10.238281 C 25.476563 10.039063 25.191406 9.941406 24.90625 9.96875 Z M 30.90625 9.96875 C 30.863281 9.976563 30.820313 9.988281 30.78125 10 C 30.316406 10.105469 29.988281 10.523438 30 11 L 30 44 C 29.996094 44.359375 30.183594 44.695313 30.496094 44.878906 C 30.808594 45.058594 31.191406 45.058594 31.503906 44.878906 C 31.816406 44.695313 32.003906 44.359375 32 44 L 32 11 C 32.011719 10.710938 31.894531 10.433594 31.6875 10.238281 C 31.476563 10.039063 31.191406 9.941406 30.90625 9.96875 Z" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                            <td>
                                <input value="{{ $error->id }}" type="checkbox" name="errors[]">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $errors->appends($_GET)->links() }}
    @else
        <p>No Error</p>
    @endif
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#group-delete").click(function() {
            let errors_id = $("input[name='errors[]']:checked").map(function() {
                return $(this).val();
            }).get();


            axios.post("{{ route('errors.groupDelete') }}", {
                data: {
                    errors_id: errors_id
                }
            }).then(
                function(response) {
                    location.reload();
                }
            );
        })

        $("#select-all").change(function(e) {
            let checked_status = this.checked
            $("input[name='errors[]']").prop("checked", checked_status);
        })
    </script>
@endsection
