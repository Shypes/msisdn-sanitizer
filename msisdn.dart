msisdn_sanitizer(msisdn, phone_code, [leading_zero=false, plus=true]) { 
    msisdn = msisdn.trim();
    msisdn = msisdn.replaceAll('+', '');
    msisdn =  msisdn.replaceAll(RegExp(r'[^0-9]'), ''); 
    phone_code = phone_code.replaceAll('+', '');
    var regex = RegExp("^(${phone_code})+");
    msisdn = msisdn.replaceAll(regex, phone_code);
    regex = new RegExp("^${phone_code}");
    if (regex.hasMatch(msisdn)) {
      msisdn = msisdn.substring(phone_code.length);
    }
    if(!leading_zero){
        msisdn = msisdn.replaceAll(RegExp(r'^0+'), '');
    }
    msisdn = "${phone_code}${msisdn}";
    if(plus){
        msisdn = "+${msisdn}";
    }
    return msisdn;
}  

void main() { 
    print(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
    print(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
    print(msisdn_sanitizer("08030000000", "+234")); // +2348030000000
    print(msisdn_sanitizer("8030000000", "+234")); // +2348030000000
    print(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")); // +2348030000000
    print(msisdn_sanitizer("+234803000kddskdskf0000", "+234")); // +2348030000000
    print(msisdn_sanitizer("+234000000080 3000 00 00","+234")); // +2348030000000
    print(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")); // +2348030000000
}  