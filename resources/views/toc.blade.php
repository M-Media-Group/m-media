@extends('layouts.app')

@section('above_container')
<div class="header-section bg-secondary">
  <h1>Terms and Conditions</h1>
</div>
@endsection

@section('content')
<h2>1. Terms</h2>
<p>By accessing the website at <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>
<h2>2. Use License</h2>
<ol type="a">
   <li>Permission is granted to temporarily download one copy of the materials (information or software) on {{ config('app.name') }}'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
   <ol type="i">
       <li>modify or copy the materials;</li>
       <li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
       <li>attempt to decompile or reverse engineer any software contained on {{ config('app.name') }}'s website;</li>
       <li>remove any copyright or other proprietary notations from the materials; or</li>
       <li>transfer the materials to another person or "mirror" the materials on any other server.</li>
   </ol>
    </li>
   <li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by {{ config('app.name') }} at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</li>
</ol>
<h2>3. Disclaimer</h2>
<ol type="a">
   <li>The materials on {{ config('app.name') }}'s website are provided on an 'as is' basis. {{ config('app.name') }} makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</li>
   <li>Further, {{ config('app.name') }} does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</li>
</ol>
<h2>4. Limitations</h2>
<p>In no event shall {{ config('app.name') }} or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on {{ config('app.name') }}'s website, even if {{ config('app.name') }} or a {{ config('app.name') }} authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
<h2>5. Accuracy of materials</h2>
<p>The materials appearing on {{ config('app.name') }}'s website could include technical, typographical, or photographic errors. {{ config('app.name') }} does not warrant that any of the materials on its website are accurate, complete or current. {{ config('app.name') }} may make changes to the materials contained on its website at any time without notice. However {{ config('app.name') }} does not make any commitment to update the materials.</p>
<h2>6. Links</h2>
<p>{{ config('app.name') }} has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by {{ config('app.name') }} of the site. Use of any such linked website is at the user's own risk.</p>
<h2>7. Modifications</h2>
<p>{{ config('app.name') }} may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
<h2>8. Governing Law</h2>
<p>These terms and conditions are governed by and construed in accordance with the laws of {{ config('blog.country_name') }} and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
<h2>9. Client Terms</h2>
<p>These terms and conditions apply to all paying Clients.</p>
<ol type="a">
   <li>{{ config('app.name') }} provides services and products in a timely manner as communicated to the Client. All work created for the customer belongs to the customer upon payment for said work.</li>
   <li>All payments are non-refundable and considered earned upon receipt. All work may cease if any payments are not received or payments are delayed for a duration longer than 30 days after the payment due date. If {{ config('app.name') }} determines it necessary to pursue collections on any late payments/overdue receivables, the Client will be liable for all costs associated with the collections efforts including, but not limited to, all legal costs.</li>
</ol>
@endsection
