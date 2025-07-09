<?php

namespace Database\Seeders;

use App\Models\TermAndCondition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('term_and_conditions')->truncate();
        // Create term & condition
        TermAndCondition::create([
            'id' => 1,
            'description' => 'Terms and conditions for a tours website and mobile app should outline user responsibilities, acceptable use, and limitations on liability. They should also address booking procedures, cancellations, and potential changes to tours. Accessibility and clear language are crucial for user understanding. 
Here a breakdown of key areas and sample clauses for your Terms and Conditions:
I. Introduction & Acceptance:
Purpose:
Clearly state the purpose of the document – to define the legal agreement between the user and the tour operator.
Acceptance:
Explain that by using the website or app, users agree to be bound by these terms.
Sample: "By accessing or using our website/mobile application, you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please do not use our services." 
II. User Accounts:
Registration:
Detail the requirements for creating and managing user accounts, including providing accurate information.
Account Security:
Outline user responsibilities for maintaining the security of their accounts.
Sample: "Users are responsible for maintaining the confidentiality of their account information and are liable for all activities conducted through their account." 
III. Tour Bookings & Payments:
Booking Process:
Explain the steps involved in booking a tour, including selecting dates, number of participants, and payment methods.
Payment Terms:
Clearly outline accepted payment methods, pricing details, and any applicable taxes or fees.
Confirmation:
Specify how users will receive booking confirmations.
Sample: "All bookings are subject to availability. Full payment is required to confirm a booking. Confirmation of your booking will be sent to the email address provided during registration." 
IV. Cancellation & Changes:
Cancellation Policy:
Clearly state the cancellation policy, including deadlines, refund policies, and any associated fees.
Changes by the Company:
Outline the company right to make changes to tour itineraries or cancel tours due to unforeseen circumstances.
Sample: "Cancellations made within [Number] days of the tour date are subject to a [Percentage]% cancellation fee. The Company reserves the right to modify or cancel tours due to unforeseen circumstances, and in such cases, users will be offered alternative options or a full refund." 
V. Intellectual Property:
Ownership:
State that the website and its content are protected by intellectual property laws.
User Content:
Address the rights to user-generated content, if applicable.
Sample: "All content on this website, including text, images, and videos, is the property of [Company Name] and protected by copyright laws." 
VI. User Conduct & Prohibited Activities:
Acceptable Use: Define what constitutes acceptable use of the website and app.
Prohibited Activities: List any activities that are not permitted, such as spamming, harassment, or illegal activities.
Sample: "Users are prohibited from engaging in any activity that could disrupt the functionality of the website or app, or that infringes on the rights of others." 
VII. Limitation of Liability:
Disclaimer:
State that the company is not liable for any damages arising from the use of the website or app, including indirect or consequential damages.
Third-Party Links:
Address the use of links to third-party websites.
Sample: "The Company is not liable for any damages arising from the use of third-party websites linked to from our website." 
VIII. Governing Law & Dispute Resolution:
Jurisdiction: Specify the governing law and jurisdiction for any disputes.
Dispute Resolution: Outline the process for resolving disputes, such as through mediation or arbitration.
Sample: "These Terms and Conditions shall be governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising from these Terms and Conditions shall be resolved through [Dispute Resolution Method]." 
IX. Contact Information:
Customer Support: Provide contact information for customer support.
Feedback: Encourage users to provide feedback on the website and app.
Sample: "For any questions or concerns, please contact us at [Email Address] or [Phone Number]." 
X. Updates:
Policy Changes: State that the company may update these Terms and Conditions from time to time.',
        ]);
    }
}
