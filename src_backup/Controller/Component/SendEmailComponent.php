<?php

//cod is used to implement the eMail

namespace App\Controller\Component;

use Cake\Controller\Component;
use App\Oad\Commons\Utils\CommonLists;
use App\Oad\Commons\Utils\ConstantValues;

//use Cake\Network\Email\Email;

class SendEmailComponent extends Component {

    // private $cList;


    public function sendOfferLetterHR($intern_code, $name, $email, $research_type, $joining_date, $emailSubject, $emailFrom) {
        $emailid = trim($email);
        $subject = $emailSubject;

        $headers = "MIME-Version:1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: aapresearchteam@gmail.com\r\n";
        $headers .= 'Bcc: testmailvinit@gmail.com' . "\r\n";

        $message = "";

        $message .= '<p>AamAadmi Party</p>
<p>206, Rouse Avenue, DeenDayalUpadhyayaMarg</p>
<p>ITO, New Delhi -110002.</p>
<p>Telephone :+91-9718500606</p>
<p>Email :<a href="mailto:contact@aamaadmiparty.org">contact@aamaadmiparty.org</a><br /> Website : <a href="http://www.aamaadmiparty.org">www.aamaadmiparty.org</a></p>
<p>Intern Code - ' . $intern_code . '</p>
<p style="text-align: center;"><strong><u>Offer for Internship </u></strong></p>
<p>Mr./Ms. ' . $name . ', it gives us great pleasure to offer you an Intern position at Human Resource Cell, AamAadmi Party (AAP).</p>
<p><u>Below are the details for the same:</u><br /> <br /> <strong>Job Title -</strong> Intern <br /> <br /> <strong>Joining Date</strong> - ' . $joining_date . '<br /> <br /> <strong>Duration</strong> - 3 months<br /> <br /> <strong>Job location</strong> - At office <br /> <br /> <strong>Responsibilities</strong> - The key responsibilities would include but not limited to the following:-</p>
<ul>
<li>As a member of the Human Resource Cell, you would be handling various operationsand managing the human resource within the organization.</li>
<li>You would be asked to coordinate with different team mates, prepare reports, helping in increasing social media presence.</li>
<li>Track the progress of various departments and keep a check on the progress of various Team Leaders.</li>
<li>You would be bound to follow the non-disclosure policy and in any situation should not compromise any data, techniques or any other information shared with you.</li>
</ul>
<p><strong>Targets</strong> - Would be set for each individual depending upon the nature of work and time</p>
<p><strong>Commitment withus</strong> - The same shall be decided on the day of joining and shall be reviewed and revised on periodic basis.</p>
<p><strong>Salary, Benefits and Reimbursement</strong> - No salary or stipend would be given during entire internship. No travelling or other contingencies would be given to any intern.</p>
<p><strong>Termination Policy</strong> - The research cell reserves the right to discontinue internship of any candidate on the disciplinary grounds and on non-performance of the candidate. The decision of the research cell shall be deemed final. The decision of the research cell would be based on the rules and regulations of the research cell, after taking advice from mentor of the intern.</p>
<p>Sincerely,</p>
<p>Arjun Joshi</p>
<p>Head, Research and Policy Cell</p>
<p>AamAadmi Party</p>
';


        $to = $emailid;
        //$to='pritamjaghab@itbp.gov.in';
        //$to='softeng.mahee@gmail.com';
        //$from = "ITBP <donotreplyrect@itbp.gov.in>";
        $from = $emailFrom;

        if (PHP_OS == 'Linux') {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        } else {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        }
    }

    public function sendOfferLetterPR($intern_code, $name, $email, $research_type, $joining_date, $emailSubject, $emailFrom) {
        $emailid = trim($email);
        $subject = $emailSubject;

        $headers = "MIME-Version:1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: aapresearchteam@gmail.com\r\n";
        $headers .= 'Bcc: testmailvinit@gmail.com' . "\r\n";
        $message = "";


        $message .= '<p>AamAadmi Party</p>
<p>206, Rouse Avenue, DeenDayalUpadhyayaMarg</p>
<p>ITO, New Delhi -110002.</p>
<p>T:+91-9718500606</p>
<p>Email :<a href="mailto:contact@aamaadmiparty.org">contact@aamaadmiparty.org</a><br /> Website : <a href="http://www.aamaadmiparty.org">www.aamaadmiparty.org</a></p>
<p>Intern Code - ' . $intern_code . '</p>
<p>&nbsp;</p>
<p style="text-align: center;"><strong><u>Offer for Internship </u></strong></p>
<p>Mr./Ms. ' . $name . ', it gives us great pleasure to offer you an Intern position at Research and Policy Cell, AamAadmi Party (AAP).</p>
<p><u>Below are the details for the same:</u><br /> <br /> <strong>Job Title -</strong> Intern <br /> <br /> <strong>Joining Date</strong> -' . $joining_date . '<br /> <br /> <strong>Duration</strong> - 2 months<br /> <br /> <strong>Job location</strong> - At office <br /> <br /> <strong>Responsibilities</strong> - The key responsibilities would include but not limited to the following:-</p>
<ul>
<li>As a member of Research and Policy Cell, you would be contributing in the research work on various issues and topics as and when provided by the Team Leaders.</li>
<li>You would be asked to coordinate with different team mates, prepare reports, helping in increasing social media presence.</li>
<li>You would be contributing to improve and enhance social media presence of the work done by the organization so far.</li>
<li>You would be bound to follow the non-disclosure policy and in any situation should not compromise any data, techniques or any other information shared with you.</li>
</ul>
<p><strong>Targets</strong> - Would be set for each individual depending upon the nature of work and time</p>
<p><strong>Commitment withus</strong> - The same shall be decided on the day of joining and shall be reviewed and revised on periodic basis.</p>
<p><strong>Salary, Benefits and Reimbursement</strong> - No salary or stipend would be given during entire internship. No travelling or other contingencies would be given to any intern.</p>
<p><strong>Termination Policy</strong> - The research cell reserves the right to discontinue internship of any candidate on the disciplinary grounds and on non-performance of the candidate. The decision of the research cell shall be deemed final. The decision of the research cell would be based on the rules and regulations of the research cell, after taking advice from mentor of the intern.</p>
<p>Sincerely,</p>
<p>Arjun Joshi</p>
<p>Head, Research and Policy Cell</p>
<p>AamAadmi Party</p>';




        $to = strtolower($emailid);
        //$to='pritamjaghab@itbp.gov.in';
        //$to='softeng.mahee@gmail.com';
        //$from = "ITBP <donotreplyrect@itbp.gov.in>";
        $from = $emailFrom;
        if (PHP_OS == 'Linux') {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        } else {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        }
    }

    public function sendOfferLetterSM($intern_code, $name, $email, $research_type, $joining_date, $emailSubject, $emailFrom) {
        $emailid = trim($email);
        $subject = $emailSubject;

        $headers = "MIME-Version:1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: aapresearchteam@gmail.com\r\n";
        $headers .= 'Bcc: testmailvinit@gmail.com' . "\r\n";
        $message = "";


        $message .= '<p>AamAadmi Party</p>
<p>206, Rouse Avenue, DeenDayalUpadhyayaMarg</p>
<p>ITO, New Delhi -110002.</p>
<p>Telephone :+91-9718500606</p>
<p>Email :<a href="mailto:contact@aamaadmiparty.org">contact@aamaadmiparty.org</a><br /> Website : <a href="http://www.aamaadmiparty.org">www.aamaadmiparty.org</a></p>
<p>Intern Code - ' . $intern_code . '</p>
    
<p style="text-align: center;"><strong><u>Offer for Internship </u></strong></p>
<p>Mr./Ms. ' . $name . ', it gives us great pleasure to offer you an Intern position at Social MediaCell, AamAadmi Party (AAP).</p>
<p><u>Below are the details for the same:</u><br /> <br /> <strong>Job Title -</strong> Intern <br /> <br /> <strong>Joining Date</strong> -' . $joining_date . '<br /> <br /> <strong>Duration</strong> - 3 months<br /> <br /> <strong>Job location</strong> - At office <br /> <br /> <strong>Responsibilities</strong> - The key responsibilities would include but not limited to the following:-</p>
<ul>
<li>As a member of the Human Resource Cell, you would be handling various social media official accounts.</li>
<li>You would be asked to coordinate with different team mates, prepare reports, helping in increasing social media presence.</li>
<li>You would be bound to follow the non-disclosure policy and in any situation should not compromise any data, techniques or any other information shared with you.</li>
</ul>
<p><strong>Targets</strong> - Would be set for each individual depending upon the nature of work and time</p>
<p><strong>Commitment withus</strong> - The same shall be decided on the day of joining and shall be reviewed and revised on periodic basis.</p>
<p><strong>Salary, Benefits and Reimbursement</strong> - No salary or stipend would be given during entire internship. No travelling or other contingencies would be given to any intern.</p>
<p><strong>Termination Policy</strong> - The research cell reserves the right to discontinue internship of any candidate on the disciplinary grounds and on non-performance of the candidate. The decision of the research cell shall be deemed final. The decision of the research cell would be based on the rules and regulations of the research cell, after taking advice from mentor of the intern.</p>
<p>Sincerely,</p>
<p>Arjun Joshi</p>
<p>Head, Research and Policy Cell</p>
<p>AamAadmi Party</p>';


        $to = $emailid;
        //$to='pritamjaghab@itbp.gov.in';
        //$to='softeng.mahee@gmail.com';
        //$from = "ITBP <donotreplyrect@itbp.gov.in>";
        $from = $emailFrom;

        if (PHP_OS == 'Linux') {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        } else {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        }
    }

    public function sendOfferLetterLegal($intern_code, $name, $email, $research_type, $joining_date, $emailSubject, $emailFrom) {
        $emailid = trim($email);
        $subject = $emailSubject;

        $headers = "MIME-Version:1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: aapresearchteam@gmail.com\r\n";
        $headers .= 'Bcc: testmailvinit@gmail.com' . "\r\n";
        $message = "";


        $message .= '<p>AamAadmi Party</p>
<p>206, Rouse Avenue, DeenDayal Upadhyaya Marg</p>
<p>ITO, New Delhi -110002.</p>
<p>Telephone:+91-9718500606</p>
<p>Email:<a href="mailto:contact@aamaadmiparty.org">contact@aamaadmiparty.org</a><br /> Website : <a href="http://www.aamaadmiparty.org">www.aamaadmiparty.org</a></p>
<p>Intern Code - ' . $intern_code . '</p>
<p style="text-align: center;"><strong><u>Offer for Internship </u></strong></p>
<p>Mr./Ms. ' . $name . ', it gives us great pleasure to offer you an Intern position at LegalCell, AamAadmi Party (AAP).</p>
<p><u>Below are the details for the same:</u><br /> <br /> <strong>Job Title -</strong> Intern <br /> <br /> <strong>Joining Date</strong> -' . $joining_date . '<br /> <br /> <strong>Duration</strong> - 2 months<br /> <br /> <strong>Job location</strong> - At office <br /> <br /> <strong>Responsibilities</strong> - The key responsibilities would include but not limited to the following:-</p>
<ul>
<li>As a member of the Legal Cell, you would bedoing extensive research on various Legal issues relating to various Acts.</li>
<li>You would be asked to provide long term and short-term researches based on various scenarios that might come up.</li>
<li>You would be bound to follow the non-disclosure policy and, in any situation, should not compromise any data, techniques or any other information shared with you.</li>
</ul>
<p><strong>Targets</strong> - Would be set for each individual depending upon the nature of work and time</p>
<p><strong>Commitment withus</strong> - The same shall be decided on the day of joining and shall be reviewed and revised on periodic basis.</p>
<p><strong>Salary, Benefits and Reimbursement</strong> - No salary or stipend would be given during entire internship. No travelling or other contingencies would be given to any intern.</p>
<p><strong>Termination Policy</strong> - The research cell reserves the right to discontinue internship of any candidate on the disciplinary grounds and on non-performance of the candidate. The decision of the research cell shall be deemed final. The decision of the research cell would be based on the rules and regulations of the research cell, after taking advice from mentor of the intern.</p>
<p>Sincerely,</p>
<p>Arjun Joshi</p>
<p>Head, Research and Policy Cell</p>
<p>AamAadmi Party</p>';


        $to = $emailid;
        //$to='pritamjaghab@itbp.gov.in';
        //$to='softeng.mahee@gmail.com';
        //$from = "ITBP <donotreplyrect@itbp.gov.in>";
        $from = $emailFrom;

        if (PHP_OS == 'Linux') {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        } else {
            if (mail($to, $subject, $message, $headers)) {
                return 1;
            } else {
                return 0;
            }
            return 1;
        }
    }

}
