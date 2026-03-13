<?php

namespace App\Marketplace\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\View\View;

class MarketplaceController extends BaseController
{
    /**
     * Maps URL slugs to blade view paths under resources/views/marketplace/pages/
     * Keys with & in filenames use a URL-safe slug as the key.
     */
    private array $viewMap = [
        // Main pages
        '' => 'marketplace.pages.index',
        'about' => 'marketplace.pages.about',
        'contact' => 'marketplace.pages.contact',
        'thank-you' => 'marketplace.pages.thank-you',
        'privacy-policy' => 'marketplace.pages.privacy-policy',
        'terms-and-condition' => 'marketplace.pages.terms-and-condition',
        'how-it-works' => 'marketplace.pages.how-it-works',

        // Course listings
        'courses' => 'marketplace.pages.courses',
        'top-courses' => 'marketplace.pages.top-courses',
        'professional-courses' => 'marketplace.pages.professional-courses',
        'certification-programs' => 'marketplace.pages.certification-programs',
        'all-programs' => 'marketplace.pages.all-programs',

        // Level grids
        'level-3-grid' => 'marketplace.pages.level-3-grid',
        'level-4-grid-courses' => 'marketplace.pages.level-4-grid-courses',
        'level-5-grid' => 'marketplace.pages.level-5-grid',

        // Subject categories
        'engineering-architecture-design' => 'marketplace.pages.engineering-architecture-design',
        'information-technology-ai' => 'marketplace.pages.information-technology-ai',
        'account-finance-training-grid-courses' => 'marketplace.pages.account-finance-training-grid-courses',
        'digital-marketing-management' => 'marketplace.pages.digital-marketing-management',

        // Level 3 programs
        'level-3-award-in-assessing-vocationally-related-achievement' => 'marketplace.pages.level-3-award-in-assessing-vocationally-related-achievement',
        'level-3-diploma-in-education-and-training' => 'marketplace.pages.level-3-diploma-in-education-and-training',
        'level-3-foundation-diploma-in-accountancy' => 'marketplace.pages.level-3-foundation-diploma-in-accountancy',
        'level-3-foundation-diploma-in-higher-education' => 'marketplace.pages.level-3-foundation-diploma-in-higher-education',

        // Level 4 & 5 programs (& replaced with -and- in URL)
        'level-4-and-5-diploma-in-business-management' => 'marketplace.pages.level-4&5-diploma-in-business-management',
        'level-4-and-5-diploma-in-hospitality-tourism-management' => 'marketplace.pages.level-4&5-diploma-in-hospitality-tourism-management',
        'level-4-and-5-diploma-in-information-technology' => 'marketplace.pages.level-4&5-diploma-in-information-technology',
        'level-4-and-5-diploma-in-psychology' => 'marketplace.pages.level-4&5-diploma-in-psychology',
        'level-4-and-5-diploma-in-accounting-and-business' => 'marketplace.pages.level-4-and-5-diploma-in-accounting-and-business',
        'level-4-and-5-diploma-in-education-and-training' => 'marketplace.pages.level-4-and-5-diploma-in-education-and-training',
        'level-4-certificate-in-leading-internal-quality-assurance' => 'marketplace.pages.level-4-certificate-in-leading-internal-quality-assurance',
        'level-4-diploma-in-business-management' => 'marketplace.pages.level-4-diploma-in-business-management',
        'level-5-diploma-in-accounting-and-business' => 'marketplace.pages.level-5-diploma-in-accounting-and-business',
        'level-5-diploma-in-business-management' => 'marketplace.pages.level-5-diploma-in-business-management',

        // Online engineering diplomas
        'online-automobile-engineering-higher-international-diploma' => 'marketplace.pages.online-automobile-engineering-higher-international-diploma',
        'online-biomedical-engineering-diploma-program' => 'marketplace.pages.online-biomedical-engineering-diploma-program',
        'online-chemical-engineering-diploma' => 'marketplace.pages.online-chemical-engineering-diploma',
        'online-civil-engineering-higher-international-diploma' => 'marketplace.pages.online-civil-engineering-higher-international-diploma',
        'online-electrical-electronics-engineering-higher-international-diploma' => 'marketplace.pages.online-electrical-electronics-engineering-higher-international-diploma',
        'online-electrical-vehicle-engineering-course' => 'marketplace.pages.online-electrical-vehicle-engineering-course',
        'online-level3-engineering-diploma' => 'marketplace.pages.online-level3-engineering-diploma',
        'online-mechanical-engineering-higher-international-diploma' => 'marketplace.pages.online-mechanical-engineering-higher-international-diploma',
        'online-mechatronics-engineering-diploma-program' => 'marketplace.pages.online-mechatronics-engineering-diploma-program',
        'online-quantity-survey-engineering-diploma' => 'marketplace.pages.online-quantity-survey-engineering-diploma',

        // Specialized programs
        'study-artificial-intelligence-diploma-program' => 'marketplace.pages.study-artificial-intelligence-diploma-program',
        'study-online-blockchain-and-technology-diploma-program' => 'marketplace.pages.study-online-blockchain-and-technology-diploma-program',
        'study-online-data-analysis-course' => 'marketplace.pages.study-online-data-analysis-course',
        'study-online-data-science-with-ai' => 'marketplace.pages.study-online-data-science-with-ai',
        'study-online-design-engineering-program' => 'marketplace.pages.study-online-design-engineering-program',
        'study-online-petroleum-engineering-diploma-program' => 'marketplace.pages.study-online-petroleum-engineering-diploma-program',
        'study-online-property-management-diploma' => 'marketplace.pages.study-online-property-management-diploma',
        'study-online-python-web-development-course' => 'marketplace.pages.study-online-python-web-development-course',
        'automation-robotics-engineering-program' => 'marketplace.pages.automation-robotics-engineering-program',
        'automotive-diagnostics-engineering-course' => 'marketplace.pages.automotive-diagnostics-engineering-course',
        'cyber-security-with-ai' => 'marketplace.pages.cyber-security-with-ai',
        'facade-engineering' => 'marketplace.pages.facade-engineering',
        'health-administration' => 'marketplace.pages.health-administration',
        'marketing-management-sales-management-programme' => 'marketplace.pages.marketing-management-sales-management-programme',
        'oracle-financials-training-course-in-UAE' => 'marketplace.pages.oracle-financials-training-course-in-UAE',
        'project-management' => 'marketplace.pages.project-management',

        // Location-based
        'hyderabad' => 'marketplace.pages.hyderabad',
        'landing-page-online-degree' => 'marketplace.pages.landing-page-online-degree',

        // Best courses (Hyderabad SEO pages)
        'best-artificial-intelligence-course-in-hyderabad' => 'marketplace.pages.best-artificial-intelligence-course-in-hyderabad',
        'best-blockchain-courses-in-hyderabad' => 'marketplace.pages.best-blockchain-courses-in-hyderabad',
        'best-cyber-security-course-in-hyderabad' => 'marketplace.pages.best-cyber-security-course-in-hyderabad',
        'best-data-analysis-course-in-hyderabad' => 'marketplace.pages.best-data-analysis-course-in-hyderabad',
        'best-digital-marketing-course-in-hyderabad' => 'marketplace.pages.best-digital-marketing-course-in-hyderabad',
        'best-oracle-courses-in-hyderabad' => 'marketplace.pages.best-oracle-courses-in-hyderabad',
        'best-python-full-stack-course-in-hyderabad' => 'marketplace.pages.best-python-full-stack-course-in-hyderabad',
    ];

    public function home(): View
    {
        return view('marketplace.pages.index');
    }

    public function show(string $slug): View
    {
        if (! array_key_exists($slug, $this->viewMap)) {
            abort(404);
        }

        return view($this->viewMap[$slug]);
    }
}
