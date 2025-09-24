@extends(template() . 'layouts.app')
@section('title', trans('API Docs'))

@section('content')
    <div id="block_api" class="pt-5 pb-5">
        <div class="block-api">
            <div class="bg"></div>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="center-big-content-block">
                                <h2 class="mb-3">API</h2>
                                <div class="table-responsive mb-3">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="width-40">HTTP Method</td>
                                                <td>POST</td>
                                            </tr>
                                            <tr>
                                                <td>API URL</td>
                                                <td>{{ route('userApiKey') }}</td>
                                            </tr>
                                            <tr>
                                                <td>API Key</td>
                                                <td>Get an API key on the
                                                    <a href="{{ route('user.profile') }}">Account</a> page
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Response format</td>
                                                <td>JSON</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="mb-3">Service list</h4>
                                <div class="table-bg">
                                    <div class="table-wr ">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">Parameters</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>services</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>[
      {
          "service": 1,
          "name": "Followers",
          "type": "Default",
          "category": "First Category",
          "rate": "0.90",
          "min": "50",
          "max": "10000",
      },
      {
          "service": 2,
          "name": "Comments",
          "type": "Custom Comments",
          "category": "Second Category",
          "rate": "8",
          "min": "10",
          "max": "1500",
      }
  ]
  </pre>
                                <h4 class="mb-3">Add order</h4>
                                {{-- <form class="">
                                    <div class="form-group">
                                        <select class="form-control input-sm" id="service_type">
                                            <option value="0">Default</option>
                                            <option value="2">Custom Comments</option>
                                            <option value="15">Comment Likes</option>
                                            <option value="17">Poll</option>
                                            <option value="100">Subscriptions</option>
                                        </select>
                                    </div>
                                </form> --}}
                                <div id="type_0" style="">
                                    <div class="table-bg">
                                        <div class="table-wr ">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="width-40">Parameters</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>key</td>
                                                        <td>Your API key</td>
                                                    </tr>
                                                    <tr>
                                                        <td>action</td>
                                                        <td>add</td>
                                                    </tr>
                                                    <tr>
                                                        <td>service</td>
                                                        <td>Service ID</td>
                                                    </tr>
                                                    <tr>
                                                        <td>link</td>
                                                        <td>Link to page</td>
                                                    </tr>
                                                    <tr>
                                                        <td>quantity</td>
                                                        <td>Needed quantity</td>
                                                    </tr>
                                                    <tr>
                                                        <td>runs (optional)</td>
                                                        <td>Runs to deliver</td>
                                                    </tr>
                                                    <tr>
                                                        <td>interval (optional)</td>
                                                        <td>Interval in minutes</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
      "status": "success",
      "order": 23501
  }
  </pre>
                                <h4 class="mb-3">Order status</h4>
                                <div class="table-bg">
                                    <div class="table-wr ">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">Parameters</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>status</td>
                                                </tr>
                                                <tr>
                                                    <td>order</td>
                                                    <td>Order ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
      "charge": "0.27819",
      "start_count": "3572",
      "status": "Partial",
      "remains": "157",
      "currency": "USD"
  }
  </pre>
                                <h4 class="mb-3">Multiple orders status</h4>
                                <div class="table-bg">
                                    <div class="table-wr ">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">Parameters</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>status</td>
                                                </tr>
                                                <tr>
                                                    <td>orders</td>
                                                    <td>Order IDs (separated by a comma, up to 100 IDs)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>[
                                    {
                                       "order": 116,
                                       "status": "Processing",
                                       "charge": "3.60",
                                       "start_count": 10,
                                       "remains": 0
                                    },
                                    {
                                       "order": 117,
                                       "status": "Completed",
                                       "charge": null,
                                       "start_count": 0,
                                       "remains": 0
                                    }
                                 ]
  </pre>
                                <h4 class="mb-3">Create refill</h4>
                                <div class="table-bg">
                                    <div class="table-wr ">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">Parameters</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill</td>
                                                </tr>
                                                <tr>
                                                    <td>order</td>
                                                    <td>Order ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
      "refill": "1"
  }
  </pre>
                                <h4 class="mb-3">Get refill status</h4>
                                <div class="table-bg">
                                    <div class="table-wr ">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">Parameters</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill_status</td>
                                                </tr>
                                                <tr>
                                                    <td>refill</td>
                                                    <td>Refill ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
      "status": "Completed"
  }
  </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
