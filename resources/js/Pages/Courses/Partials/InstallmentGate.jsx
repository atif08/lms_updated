export default function InstallmentGate({ installmentNo, onPay }) {
    return (
        <div className="mx-3 my-2 rounded-xl border border-amber-200 bg-amber-50 p-4 text-center">
            <div className="text-xl mb-1">🔒</div>
            <p className="text-xs font-semibold text-amber-800">
                Installment {installmentNo} Required
            </p>
            <p className="text-xs text-amber-600 mt-0.5 mb-3">
                Pay installment {installmentNo} to unlock this section
            </p>
            <button
                onClick={() => onPay(installmentNo)}
                className="bg-indigo-600 text-white text-xs font-semibold px-4 py-1.5 rounded-lg hover:bg-indigo-700 transition-colors"
            >
                Pay Installment {installmentNo}
            </button>
        </div>
    );
}
