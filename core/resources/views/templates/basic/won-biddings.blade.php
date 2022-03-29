@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="mrg-top35">
    <div class="container-fluid">
        <div class="row  ">
            <div class="col-xxl-2 list-left-main   mt-4 p-0">
                @include('templates.basic.partials.dashboard-sidebar')
            </div>
            <div class="col-xxl-10 w-bg  my-wallet ">
                <div class="card b-radius--10 ">
                    <div class="card-header">
                        <h3>Won Bids</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            <table class="table cmn--table table-striped m-0">
                                <thead>
                                    <tr>
                                        <th>@lang('Product')</th>
                                        <!-- <th>@lang('Subcategory')</th> -->
                                        <th>@lang('Bid Amount')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($biddings as $bid)
                                    <tr>
                                        <td data-label="@lang('Title')">{{__($bid->product->title )}}</td>
                                        <td data-label="@lang('Amount')">{{__($bid->bid_amount )}}</td>

                                        <td data-label="@lang('Status')">

                                            @if($bid->status == 'A')
                                            <span class="badge bg-success">@lang('Accepted')</span>
                                            @elseif($bid->status == 'P')
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                            @else
                                            <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Date')">{{ date('d M,Y H:i:s',strtotime($bid->created_at))}}</td>
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
                    <div class="card-footer text-right">
                        {{ $biddings->links() }}
                    </div>
                </div>
                <br />
                <br />
            </div>

        </div>
    </div>
</section>

@endsection