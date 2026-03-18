import { useForm, Link, usePage } from '@inertiajs/react';
import AuthLayout from '@/Layouts/AuthLayout';

const COUNTRY_CODES = [
    '+93','+355','+213','+376','+244','+54','+374','+61','+43','+994',
    '+973','+880','+375','+32','+501','+229','+975','+591','+387','+267',
    '+55','+673','+359','+226','+257','+855','+237','+1','+238','+236',
    '+235','+56','+86','+57','+269','+242','+506','+385','+53','+357',
    '+420','+243','+45','+253','+593','+20','+503','+240','+291','+372',
    '+251','+679','+358','+33','+241','+220','+995','+49','+233','+30',
    '+502','+224','+245','+592','+509','+504','+36','+354','+91','+62',
    '+98','+964','+353','+972','+39','+1876','+81','+962','+7','+254',
    '+686','+850','+82','+965','+996','+856','+371','+961','+266','+231',
    '+218','+423','+370','+352','+261','+265','+60','+960','+223','+356',
    '+692','+222','+230','+52','+691','+373','+377','+976','+382','+212',
    '+258','+95','+264','+674','+977','+31','+64','+505','+227','+234',
    '+47','+968','+92','+680','+970','+507','+675','+595','+51','+63',
    '+48','+351','+974','+40','+7','+250','+685','+378','+239','+966',
    '+221','+381','+248','+232','+65','+421','+386','+677','+252','+27',
    '+211','+34','+94','+249','+597','+268','+46','+41','+963','+886',
    '+992','+255','+66','+670','+228','+676','+1868','+216','+90','+993',
    '+688','+256','+380','+971','+44','+1','+598','+998','+678','+379',
    '+58','+84','+967','+260','+263',
];

const inputClass = 'w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500';

export default function Register() {
    const { redirectTo } = usePage().props;
    const ref = new URLSearchParams(window.location.search).get('ref') ?? '';

    const { data, setData, post, processing, errors } = useForm({
        first_name: '',
        last_name: '',
        email: '',
        country_code: '+971',
        mobile: '',
        password: '',
        password_confirmation: '',
        ref,
        redirect_to: redirectTo ?? '/students/dashboard',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/register');
    };

    return (
        <AuthLayout>
            <h1 className="text-2xl font-bold text-gray-800 mb-2">Create an Account</h1>
            <p className="text-sm text-gray-500 mb-8">Fill in your details to get started</p>

            <form onSubmit={submit} className="space-y-5">
                <div className="grid grid-cols-2 gap-4">
                    <Field label="First Name" error={errors.first_name}>
                        <input
                            type="text"
                            value={data.first_name}
                            onChange={e => setData('first_name', e.target.value)}
                            className={inputClass}
                            placeholder="John"
                            required
                        />
                    </Field>

                    <Field label="Last Name" error={errors.last_name}>
                        <input
                            type="text"
                            value={data.last_name}
                            onChange={e => setData('last_name', e.target.value)}
                            className={inputClass}
                            placeholder="Doe"
                            required
                        />
                    </Field>
                </div>

                <Field label="Email" error={errors.email}>
                    <input
                        type="email"
                        value={data.email}
                        onChange={e => setData('email', e.target.value)}
                        className={inputClass}
                        placeholder="you@example.com"
                        required
                    />
                </Field>

                <Field label="Mobile Number" error={errors.mobile}>
                    <div className="flex gap-2">
                        <select
                            value={data.country_code}
                            onChange={e => setData('country_code', e.target.value)}
                            className="rounded-lg border border-gray-300 px-2 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white w-24 shrink-0"
                        >
                            {COUNTRY_CODES.map(c => (
                                <option key={c} value={c}>{c}</option>
                            ))}
                        </select>
                        <input
                            type="tel"
                            value={data.mobile}
                            onChange={e => setData('mobile', e.target.value)}
                            className={`${inputClass} flex-1`}
                            placeholder="5X XXX XXXX"
                            required
                        />
                    </div>
                </Field>

                <Field label="Password" error={errors.password}>
                    <input
                        type="password"
                        value={data.password}
                        onChange={e => setData('password', e.target.value)}
                        className={inputClass}
                        placeholder="Min. 8 characters"
                        required
                    />
                </Field>

                <Field label="Confirm Password" error={errors.password_confirmation}>
                    <input
                        type="password"
                        value={data.password_confirmation}
                        onChange={e => setData('password_confirmation', e.target.value)}
                        className={inputClass}
                        placeholder="Repeat your password"
                        required
                    />
                </Field>

                <Field label="Referral Code (optional)" error={errors.ref}>
                    <input
                        type="text"
                        value={data.ref}
                        onChange={e => setData('ref', e.target.value.toUpperCase())}
                        className={inputClass}
                        placeholder="Enter teacher referral code"
                    />
                </Field>

                <button
                    type="submit"
                    disabled={processing}
                    className="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-50 flex items-center justify-center gap-2"
                >
                    {processing && (
                        <svg className="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                        </svg>
                    )}
                    {processing ? 'Creating account…' : 'Create Account'}
                </button>

                <p className="text-center text-sm text-gray-500">
                    Already have an account?{' '}
                    <Link href="/login" className="text-indigo-600 hover:text-indigo-800 font-medium">
                        Sign in
                    </Link>
                </p>
            </form>
        </AuthLayout>
    );
}

function Field({ label, error, children }) {
    return (
        <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">{label}</label>
            {children}
            {error && <p className="mt-1 text-xs text-red-500">{error}</p>}
        </div>
    );
}
