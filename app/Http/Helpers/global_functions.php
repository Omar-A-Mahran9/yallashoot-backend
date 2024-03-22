<?php

function alertUploadFileHtml(){
    return "
            <div class=\"alert alert-warning d-flex align-items-center p-5\"  id=\"alertUploadFile\" style=\"display: none\">
                <span class=\"svg-icon svg-icon-2hx svg-icon-warning me-3\">
                    <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path opacity=\"0.3\" d=\"M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z\" fill=\"currentColor\"></path>
                        <path d=\"M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z\" fill=\"currentColor\"></path>
                    </svg>
                </span>
                <div class=\"d-flex flex-column\">
                    <h4 class=\"mb-1 text-dark\">".__('Important alert to increase website performance')."</h4>
                    <ul>
                        <li>
                        ".__('In the case of attaching images, please compress the size of the images and we will recommend to you')." ( <a href=\"https://tinyjpg.com/\" target=\"_blank\">tinyjpg</a> - <a href=\"https://www.iloveimg.com/\" target=\"_blank\">iloveimg</a> ) - "
                        . __('and then convert it to webp image and we advice you to use') .    
                        " <a href=\"https://cloudconvert.com/png-to-webp/\" target=\"_blank\">cloudconvert</a>
                        </li>
                        <li class=\"fw-bold\" style=\"font-weight:bold !important\">
                            ".__("We will recommend a image ratio to be width : 604px , height : 408px")."
                        </li>
                    </ul>
                </div>
            </div>
        ";
}


if(!function_exists('convertArabicNumbers')){
    function convertArabicNumbers($string,$type = 'phone') {
        //$engish = array(0,1,2,3,4,5,6,7,8,9);

        static $fromchar = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹',
                                '٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        static $num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $convertedNumbers =  str_replace($fromchar, $num, $string);
        if($type == 'phone'){
            if(str_starts_with($convertedNumbers, '0') ){
                $convertedNumbers= substr_replace($convertedNumbers, "966", 0, 1);
            }
            if(str_starts_with($convertedNumbers, '+966') ){
                $convertedNumbers= substr_replace($convertedNumbers, "", 0, 1);
            }
            if(str_starts_with($convertedNumbers, '009660') ){
                $convertedNumbers= substr_replace($convertedNumbers, "966", 0, 6);
            }
            if(str_starts_with($convertedNumbers, '00966') ){
                $convertedNumbers= substr_replace($convertedNumbers, "", 0, 2);
            }

            if(str_starts_with($convertedNumbers, '5') ){
                $convertedNumbers= '966'.$convertedNumbers;
            }

            if(str_starts_with($convertedNumbers, '9660') ){
                $convertedNumbers= substr_replace($convertedNumbers, "966", 0, 4);

            }
        }
        return $convertedNumbers;
    }
}
