<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_us')->truncate();
        // Create term & condition
        AboutUs::create([
            'id' => 1,
            'description' => 'Privacy Policy
Effective Date: July 9, 2025

Welcome to Wanderlust Travels (“we,” “our,” or “us”). Your privacy is important to us. This Privacy Policy outlines how we collect, use, and protect your personal information when you visit our website www.tour.com or use our services.

1. Information We Collect
We may collect the following types of information:

Personal Information: Name, email address, phone number, travel preferences, passport details (if needed for bookings).

Payment Information: Credit/debit card details (processed securely via third-party payment providers).

Automatically Collected Data: IP address, browser type, pages visited, and time spent, collected through cookies and analytics tools.

2. How We Use Your Information
We use your information to:

Process bookings and inquiries.

Send confirmation emails and updates.

Improve our website and customer service.

Send promotional emails (you can opt-out anytime).

Comply with legal requirements.

3. Sharing of Information
We do not sell or rent your personal information. However, we may share it with:

Travel service providers (e.g., hotels, airlines) for reservation purposes.

Third-party partners helping us operate our website or business.

Government or legal authorities, if required by law.

4. Data Security
We use industry-standard measures (SSL, firewalls, encryption) to protect your data. However, no method of transmission over the internet is 100% secure.

5. Your Rights
You have the right to:

Access your personal data.

Correct or delete your data.

Withdraw consent for data processing.

To make a request, contact us at support@tour.com.

6. Cookies
We use cookies to enhance your browsing experience. You can disable cookies via your browser settings.

7. Third-Party Links
Our site may contain links to external websites. We are not responsible for their privacy practices.

8. Changes to This Policy
We may update this Privacy Policy from time to time. Any changes will be posted on this page with a revised "Effective Date."

9. Contact Us
For questions or concerns about this policy, contact:

Wanderlust Travels
123 Adventure Lane, Karachi, Pakistan
📧 support@tour.com
📞 +92 300 0000000',
        ]);
    }
}