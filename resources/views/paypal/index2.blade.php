<x-app-layout>
    <div>
        <div class="container">
            <div class="payment-box shadow">
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <form action="{{route('requestpayment')}}" method="POST">
                    @csrf
                    <label for="amount" class="form-label">Ingrese la cantidad</label>
                    <input type="number" class="form-control" name="amount">
                    <input type="submit" value="Pague con PayPal" class="btn btn-primary mt-2">
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .payment-box {
            padding: 30px;
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=env('PAYPAL_SANDBOX_CLIENT_ID')"></script>
</x-app-layout>
