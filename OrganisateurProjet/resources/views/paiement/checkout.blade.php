<x-app-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paiement</div>

                <div class="card-body">
                    <h4 class="mb-4">Total à payer: {{ number_format($reservation->montant_total, 2) }} €</h4>

                    <div id="payment-form">
                        <div id="card-element" class="mb-3"></div>
                        <button id="submit-button" class="btn btn-primary w-100">
                            Payer maintenant
                        </button>
                        <div id="payment-errors" class="alert alert-danger mt-3 d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const submitButton = document.getElementById('submit-button');
    const errorDiv = document.getElementById('payment-errors');

    submitButton.addEventListener('click', async () => {
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Traitement...';

        const { error, paymentMethod } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            showError(error.message);
            submitButton.disabled = false;
            submitButton.textContent = 'Payer maintenant';
            return;
        }

        try {
            const response = await fetch("{{ route('paiements.process', $reservation) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ payment_method_id: paymentMethod.id })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Erreur de paiement");
            }

            const { sessionId } = data;
            const result = await stripe.redirectToCheckout({ sessionId });

            if (result.error) {
                throw new Error(result.error.message);
            }
        } catch (error) {
            showError(error.message);
            submitButton.disabled = false;
            submitButton.textContent = 'Payer maintenant';
        }
    });

    function showError(message) {
        errorDiv.textContent = message;
        errorDiv.classList.remove('d-none');
    }
</script>

