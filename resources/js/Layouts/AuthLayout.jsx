import { usePage } from '@inertiajs/react';

export default function AuthLayout({ children }) {
    const { marketplace } = usePage().props;

    const logoSrc = marketplace ? '/images/logo-asti.png' : '/images/logo-btc.png';
    const bgSrc = '/frontend/img/login-img.jpg';

    return (
        <div className="min-h-screen flex">
            {/* Left banner */}
            <div
                className="hidden lg:flex lg:w-1/2 bg-indigo-900 items-center justify-center bg-cover bg-center relative"
                style={{ backgroundImage: `url(${bgSrc})` }}
            >
                <div className="absolute inset-0 bg-indigo-900/70" />
                <div className="relative z-10 text-center px-8">
                    <img src={logoSrc} alt="Logo" className="h-20 w-auto mx-auto mb-6" />
                    <h2 className="text-3xl font-bold text-white">Welcome Back</h2>
                    <p className="mt-2 text-indigo-200 text-sm">
                        Sign in to access your learning portal
                    </p>
                </div>
            </div>

            {/* Right form area */}
            <div className="flex flex-1 items-center justify-center px-6 py-12 bg-white">
                <div className="w-full max-w-md">
                    {/* Mobile logo */}
                    <div className="flex justify-center mb-8 lg:hidden">
                        <img src={logoSrc} alt="Logo" className="h-14 w-auto" />
                    </div>
                    {children}
                </div>
            </div>
        </div>
    );
}
