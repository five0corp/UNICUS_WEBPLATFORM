@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td data-label="@lang('Name')">{{__($article->label)}}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.articles.detail',$article->id) }}" class="icon-btn btn--primary ml-1 "><i class="las la-pen"></i></a>                           
                                        <button class="icon-btn btn--danger ml-1 removeBtn" data-id="{{ $article->id }}" data-toggle="tooltip" data-original-title="@lang('Delete')">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($articles) }}
                </div>
            </div>
        </div>
    </div>


    
    {{-- REMOVE METHOD MODAL --}}
    <div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Removal Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.articles.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to remove this article?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Remove')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.articles.detail') }}" class="btn btn-sm btn--primary box--shadow1 text--small " ><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Article')</a>
@endpush

@push('script')
<script>
    "use strict";
    $('.removeBtn').on('click', function () {
                var modal = $('#removeModal');
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });
</script>
@endpush
