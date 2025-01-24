<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class CustomComponent extends Component {

    function __construct($prompt = null) {
        
    }

    function getUniqNumber() {
        $uniq = uniqid(rand());
        return md5($uniq . time());
    }

    function getRealIpAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    //Create a valid url 
    function makeValidUrl($urlStr) {
        $parsed = parse_url($urlStr);
        if (empty($parsed['scheme'])) {
            $urlStr = 'http://' . ltrim($urlStr, '/');
            return $urlStr;
        } else {
            return $urlStr;
        }
    }

    function get_ip_address() {
        if (isSet($_SERVER)) {
            if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }

        return $realip;
    }

    function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    function number_pad($number, $n = 4, $trailing_value = 0, $position = STR_PAD_LEFT) {
        $number = intval($number, 10);
        return str_pad((int) $number, $n, $trailing_value, $position);
    }

    function get_file_extension($str) {
        $i = explode(".", $str);
        $ext = end($i);
        return strtolower($ext);
    }

    function make_seo_text($str) {
        $str = trim($str);
        $value = str_replace(" ", "-", $str);
        $value = trim($value, "-");
        return strtolower($value);
    }

    function short_length($value, $len) {
        $value_format = $this->formatText($value);
        $value_raw = html_entity_decode($value_format, ENT_QUOTES);

        if (strlen($value_raw) > $len) {
            $value_strip = substr($value_raw, 0, $len);
            $value_strip = $this->formatText($value_strip);
            $lengthvalue = "<span title='" . $value_format . "' rel='tooltip'>" . $value_strip . "...</span>";
        } else {
            $lengthvalue = $value_format;
        }

        return $lengthvalue;
    }

    function formatText($value) {
        $value = str_replace("â€œ", "\"", $value);
        $value = str_replace("ï¿½?", "\"", $value);
        //$value = preg_replace('/[^(\x20-\x7F)\x0A]*/','', $value);
        $value = stripslashes($value);
        $value = html_entity_decode($value, ENT_QUOTES);
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        $value = strtr($value, $trans);
        $value = stripslashes(trim($value));
        return $value;
    }

    //REMOVE HTML TAG FROM CONTENT
    function strip_tags_content($string) {
        // ----- remove HTML TAGs ----- 
        $string = preg_replace('/<[^>]*>/', ' ', $string);
        // ----- remove control characters ----- 
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces ----- 
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string;
    }

    function emailText($value) {
        $value = stripslashes(trim($value));
        $value = str_replace('"', "\"", $value);
        $value = str_replace('"', "\"", $value);
        $value = preg_replace('/[^(\x20-\x7F)\x0A]*/', '', $value);
        return stripslashes($value);
    }

    function sendEmail($to, $from, $subject, $message, $header = 1, $footer = 1) {
        if ($header) {
            $hdr = '<!DOCTYPE html>
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <table width="750" style="font-family:arial helvetica sans-serif" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td><table width="750" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr style="background: #000;">
                            <td>
                                <a href="' . HTTP_ROOT . '"><img src="' . HTTP_ROOT . 'img/logo.png" alt="logo" style="width: 200px;"> </a>
                            </td>
                            <td align="right" valign="bottom" style="font-family:arial;color:#0093dd;font-size:20px;padding:0 10px 10px 0"></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
        <tr>
            <td bgcolor="#fdbb40"><div style="font-size:5px;color:#52b852">&nbsp;</div></td>
        </tr>
        <tr>
            <td bgcolor="#4b4b4d"><div style="font-size:5px;color:#4b4b4d">&nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="3" style="border:1px solid #c6c6c6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td colspan="2" style="padding-left:12px;padding-right:12px;font-family:trebuchet ms,arial;font-size:13px">';
        }
        if ($footer) {

            $ftr = '</td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
        <tr>
            <td height="34" bgcolor="#f1f1f1" style="border:solid 1px #c6c6c6;border-top:0px;font-family:arial;font-size:13px;text-align:center">Visit
                our <a href="' . HTTP_ROOT . '" style="text-decoration:none" target="_blank">Help</a> center or write into us at <a style="text-decoration:none">support@mail.com</a> for any assistance you may require. 
                <p><span style="font-family:verdana"><span style="font-size:smaller"><span style="color:rgb(51, 102, 255)">This message comes from an unmonitored alias. Please do not reply directly.</span></span></span></p>
            </td>
        </tr>
    </tbody>
</table>
    </body>
    </html>';
        }

        $message = $hdr . $message . $ftr;
        $to = $this->emailText($to);
        $subject = $this->emailText($subject);
        $message = $this->emailText($message);
        $message = str_replace("<script>", "&lt;script&gt;", $message);
        $message = str_replace("</script>", "&lt;/script&gt;", $message);
        $message = str_replace("<SCRIPT>", "&lt;script&gt;", $message);
        $message = str_replace("</SCRIPT>", "&lt;/script&gt;", $message);

        $email = new Email('default');
        // $email = new Email();
        //$email->transport('default');
        $res = $email->setFrom($from)
                ->setTo($to)
                ->setEmailFormat('html')
                ->setSubject($subject)
                ->setViewVars(array('msg' => $message))
                ->send($message);
    }

    function sendEmailSMTP($to, $from, $subject, $message, $header = 1, $footer = 1) {
        if ($header) {
            $hdr = '<!DOCTYPE html>
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <table width="750" style="font-family:arial helvetica sans-serif" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td><table width="750" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr style="background: #000;">
                            <td>
                                <a href="' . HTTP_ROOT . '"><img src="' . HTTP_ROOT . 'img/logo.png" alt="logo" style="width: 200px;"> </a>
                            </td>
                            <td align="right" valign="bottom" style="font-family:arial;color:#0093dd;font-size:20px;padding:0 10px 10px 0"></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
        <tr>
            <td bgcolor="#fdbb40"><div style="font-size:5px;color:#52b852">&nbsp;</div></td>
        </tr>
        <tr>
            <td bgcolor="#4b4b4d"><div style="font-size:5px;color:#4b4b4d">&nbsp;</div></td>
        </tr>
        <tr>
            <td colspan="3" style="border:1px solid #c6c6c6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td colspan="2" style="padding-left:12px;padding-right:12px;font-family:trebuchet ms,arial;font-size:13px">';
        }
        if ($footer) {

            $ftr = '</td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
        <tr>
            <td height="34" bgcolor="#f1f1f1" style="border:solid 1px #c6c6c6;border-top:0px;font-family:arial;font-size:13px;text-align:center">Visit
                our <a href="' . HTTP_ROOT . '" style="text-decoration:none" target="_blank">Help</a> center or write into us at <a style="text-decoration:none">support@mail.com</a> for any assistance you may require. 
                <p><span style="font-family:verdana"><span style="font-size:smaller"><span style="color:rgb(51, 102, 255)">This message comes from an unmonitored alias. Please do not reply directly.</span></span></span></p>
            </td>
        </tr>
    </tbody>
</table>
    </body>
    </html>';
        }

        $message = $hdr . $message . $ftr;
        $to = $this->emailText($to);
        $subject = $this->emailText($subject);
        $message = $this->emailText($message);
        $message = str_replace("<script>", "&lt;script&gt;", $message);
        $message = str_replace("</script>", "&lt;/script&gt;", $message);
        $message = str_replace("<SCRIPT>", "&lt;script&gt;", $message);
        $message = str_replace("</SCRIPT>", "&lt;/script&gt;", $message);

        $email = new Email();
        // $email = new Email();
        //$email->transport('default');
        $res = $email->setTransport('smtpp')
                ->setFrom([$from => 'Development Test'])
                ->setTo($to)
                ->setEmailFormat('html')
                ->setSubject($subject)
                ->setViewVars(array('msg' => $message))
                ->send($message);
    }

    function formatRegister($msg, $name, $email, $link) {
        if (strstr($msg, "[NAME]")) {
            $msg = str_replace("[NAME]", $name, $msg);
        }
        if (strstr($msg, "[EMAIL]")) {
            $msg = str_replace("[EMAIL]", $email, $msg);
        }
        if (strstr($msg, "[LINK]")) {
            $msg = str_replace("[LINK]", $link, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }

    function formatForgetPassword($msg, $name, $email, $link) {
        if (strstr($msg, "[NAME]")) {
            $msg = str_replace("[NAME]", $name, $msg);
        }
        if (strstr($msg, "[EMAIL]")) {
            $msg = str_replace("[EMAIL]", $email, $msg);
        }
        if (strstr($msg, "[LINK]")) {
            $msg = str_replace("[LINK]", $link, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }

    function formatInquiry($msg, $email, $message) {
        if (strstr($msg, "[EMAIL]")) {
            $msg = str_replace("[EMAIL]", $email, $msg);
        }
        if (strstr($msg, "[MESSAGE]")) {
            $msg = str_replace("[MESSAGE]", $message, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }

    function formatContactUS($msg, $name, $email, $subject, $message) {
        if (strstr($msg, "[NAME]")) {
            $msg = str_replace("[NAME]", $name, $msg);
        }
        if (strstr($msg, "[EMAIL]")) {
            $msg = str_replace("[EMAIL]", $email, $msg);
        }
        if (strstr($msg, "[SUBJECT]")) {
            $msg = str_replace("[SUBJECT]", $subject, $msg);
        }
        if (strstr($msg, "[MESSAGE]")) {
            $msg = str_replace("[MESSAGE]", $message, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }
    function formatSchoolRegistration($msg, $schoolName, $schoolBranch, $schoolAddress, $Date, $link, $subject) {
        if (strstr($msg, "[NAME]")) {
            $msg = str_replace("[NAME]", $schoolName, $msg);
        }
        if (strstr($msg, "[BRANCH]")) {
            $msg = str_replace("[BRANCH]", $schoolBranch, $msg);
        }
        if (strstr($msg, "[ADDRESS]")) {
            $msg = str_replace("[ADDRESS]", $schoolAddress, $msg);
        }
        if (strstr($msg, "[DATE]")) {
            $msg = str_replace("[DATE]", $Date, $msg);
        }
        if (strstr($msg, "[LINK]")) {
            $msg = str_replace("[LINK]", $link, $msg);
        }
        if (strstr($msg, "[SUBJECT]")) {
            $msg = str_replace("[SUBJECT]", $subject, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }
    function formatStudentRegistration($msg, $schoolName, $schoolBranch, $schoolAddress, $Date, $link, $subject) {
        if (strstr($msg, "[NAME]")) {
            $msg = str_replace("[NAME]", $schoolName, $msg);
        }
        if (strstr($msg, "[BRANCH]")) {
            $msg = str_replace("[BRANCH]", $schoolBranch, $msg);
        }
        if (strstr($msg, "[ADDRESS]")) {
            $msg = str_replace("[ADDRESS]", $schoolAddress, $msg);
        }
        if (strstr($msg, "[DATE]")) {
            $msg = str_replace("[DATE]", $Date, $msg);
        }
        if (strstr($msg, "[LINK]")) {
            $msg = str_replace("[LINK]", $link, $msg);
        }
        if (strstr($msg, "[SUBJECT]")) {
            $msg = str_replace("[SUBJECT]", $subject, $msg);
        }
        if (strstr($msg, "[SITELINK]")) {
            $msg = str_replace("[SITELINK]", HTTP_ROOT, $msg);
        }
        return $msg;
    }
    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    function lastValue($string) {
        $explode = explode('-', $string);
        $lastArrayValue = end($explode);
        return $lastArrayValue;
    }

    function uploadImageBanner($tmp_name, $name, $path, $imgWidth) {
        //echo uploadImageBanner($tmp_name);
        
        
        if ($name) {
            $image = strtolower($name);
            $extname = $this->getExtension($image); //$extname = substr(strrchr($image, "."), 1);
            
            if (($extname != 'gif') && ($extname != 'jpg') && ($extname != 'jpeg') && ($extname != 'png') && ($extname != 'bmp')) {

                return false;
            
            } else {
                if ($extname == "jpg" || $extname == "jpeg") {
                    $src = imagecreatefromjpeg($tmp_name);
                } else if ($extname == "png") {
                    $src = imagecreatefrompng($tmp_name);
                
                } else {
                    $src = imagecreatefromgif($tmp_name);
                }
                list($width, $height) = getimagesize($tmp_name);
                if ($extname == 'gif' || $width <= $imgWidth) {
                    $time = time() . rand(100, 999);
                    $filepath = md5($time) . "." . $extname;
                    $targetpath = $path . $filepath;
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file($tmp_name, $targetpath);
                    return $filepath;
                } else {
                    $newwidth = $imgWidth;
                    $newheight = ($height / $width) * $newwidth; echo "1"; exit;
                    $tmp = imagecreatetruecolor($newwidth, $newheight);echo $tmp;exit;
                    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    $time = time();
                    $filepath = md5($time) . "." . $extname;
                    $filename = $path . $filepath;
                    imagejpeg($tmp, $filename, 100);

                    imagedestroy($src);
                    imagedestroy($tmp);
                    return $filepath;
                }
            }
        }
    }

}
