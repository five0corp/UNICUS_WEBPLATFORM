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
                                <th>@lang('Slug')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pages as $page)
                            <tr>
                                <td data-label="@lang('Title')">{{__($page->title)}}</td>
                                <td data-label="@lang('Slug')">{{__($page->slug)}}</td>

                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.policy-page.edit',$page->id) }}" class="icon-btn btn--primary ml-1" ><i class="las la-pen"></i></a>
                                    <button class="icon-btn btn--danger ml-1 removeBtn" data-id="{{ $page->id }}" data-toggle="tooltip" data-original-title="@lang('Delete')">
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
                {{ paginateLinks($pages) }}
            </div>
        </div>
    </div>
</div>


<div id="cityModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Page')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.policy-page.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Title')</label>
                        <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="@lang(" Enter Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Slug')</label>
                        <input type="text" class="form-control form-control-lg" name="slug" id="slug" placeholder="@lang(" Enter Slug")" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Content')</label>
                        <textarea class="form-control form-control-lg nicEdit" style="width:100%" name="content" id="content" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="updateCityModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update Page')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.policy-page.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Title')</label>
                        <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="@lang(" Enter Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Slug')</label>
                        <input type="text" class="form-control form-control-lg" name="slug" id="slug" placeholder="@lang(" Enter Slug")" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Content')</label>
                        <textarea class="form-control form-control-lg nicEdit" name="content" id="content" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.policy-page.create') }}" class="btn btn-sm btn--primary box--shadow1 text--small "><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Page')</a>
@endpush

@push('script')
<script>
    "use strict";
    $('.addCity').on('click', function() {
        $('#cityModel').modal('show');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.removeBtn', function(e) {
            
            e.preventDefault();
            if (confirm('Are you sure you want to delete ?')) {
                
                var id = $(this).attr('data-id');
                $.post("{{ route('admin.policy-page.delete') }}", 'id=' + id, function(data) {
                    window.location = "{{ route('admin.policy-page.index') }}";
                });
            }
        });

 

    $('.updateCity').on('click', function() {
        var modal = $('#updateCityModel');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=title]').val($(this).data('title'));
        modal.find('input[name=slug]').val($(this).data('slug'));
        modal.find('input[name=content]').val($(this).data('content'));
        // var data = $(this).data('status');
        // if (data == 1) {
        //     modal.find('input[name=status]').bootstrapToggle('on');
        // } else {
        //     modal.find('input[name=status]').bootstrapToggle('off');
        // }
        modal.modal('show');
    });
</script>
@endpush