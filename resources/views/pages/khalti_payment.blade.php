@extends('frontend.Master')

@section('content')
<div class="payment-wrapper">
    <div class="payment-card">
        <form id="khalti-payment-form">
            @csrf
            <div class="text-center">
                <div class="payment-logo">
                    <i class="bi bi-credit-card-2-front" style="font-size: 2.5rem; color: #5e2ced;"></i>
                </div>
                <h1 class="payment-title">Confirm Your Payment</h1>
            </div>

            <input type="hidden" name="total_price" value="{{ $total_amount }}">

            <div class="amount-container text-center">
                <div class="amount-label">Total Amount</div>
                <div class="amount-display">
                    {{ number_format($total_amount, 2) }}<span class="currency-code">NPR</span>
                </div>
            </div>

            <button type="submit" class="btn w-100" id="khalti-btn">
                <i class="bi bi-wallet2"></i>Pay with Khalti
            </button>

            <div class="secure-badge">
                <i class="bi bi-shield-lock-fill"></i> Secure payment via Khalti
            </div>

            <div class="payment-info text-center">
                You will be redirected to Khalti to complete your payment securely.
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('khalti-payment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('khalti-btn');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading-spinner"></span>Redirecting to Khalti...';

        fetch("{{ route('khalti.purchase',[$booking->id]) }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.khalti_url) {
                    window.location.href = data.khalti_url;
                } else {
                    showError("Error initiating payment. Please try again.");
                }
            })
            .catch(error => {
                console.error('Payment initiation failed:', error);
                showError("Something went wrong. Please try again later.");
            });
    });

    function showError(message) {
        const submitBtn = document.getElementById('khalti-btn');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-wallet2"></i>Pay with Khalti';

        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-3';
        errorDiv.role = 'alert';
        errorDiv.innerHTML = `<i class="bi bi-exclamation-triangle-fill me-2"></i>${message}`;

        const amountContainer = document.querySelector('.amount-container');
        amountContainer.parentNode.insertBefore(errorDiv, amountContainer.nextSibling);

        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }
</script>
<style>
    .payment-wrapper {
        display: flex;
        justify-content: center;
        padding: 2rem 1rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        margin-top: 60px;
        
    }

    .payment-card {
        width: 100%;
        max-width: 480px;
        padding: 2.5rem;
        border-radius: 1.5rem;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .payment-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #5e2ced, #a485fd);
    }

    .payment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .payment-logo {
        margin-bottom: 1.5rem;
    }

    .payment-logo img {
        height: 40px;
    }

    .payment-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1a1a1a;
        position: relative;
        display: inline-block;
    }

    .payment-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #5e2ced, #a485fd);
        border-radius: 3px;
    }

    .amount-container {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0 2rem;
        border: 1px solid #e9ecef;
    }

    .amount-label {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .amount-display {
        font-size: 2rem;
        font-weight: 700;
        color: #198754;
        margin: 0;
    }

    .currency-code {
        font-size: 1rem;
        color: #6c757d;
        margin-left: 0.25rem;
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1.5rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .secure-badge i {
        margin-right: 0.5rem;
        color: #198754;
    }

    #khalti-btn {
        font-size: 1.1rem;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        background: linear-gradient(90deg, #5e2ced, #a485fd);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(94, 44, 237, 0.2);
    }

    #khalti-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(94, 44, 237, 0.3);
    }

    #khalti-btn:active {
        transform: translateY(0);
    }

    #khalti-btn i {
        margin-right: 0.75rem;
        font-size: 1.2rem;
    }

    .payment-info {
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Loading animation */
    .loading-spinner {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        margin-right: 0.5rem;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection