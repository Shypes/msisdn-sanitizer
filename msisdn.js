
function msisdn_sanitizer(msisdn, phone_code, leading_zero=false, plus=true) {
    msisdn = msisdn.trim();
    msisdn = msisdn.replace('+', '');
    msisdn = msisdn.replace(/[^0-9]/ig, '')
    phone_code = phone_code.replace('+', '');
    let regex = new RegExp(`^(${phone_code})+`,"i");
    msisdn = msisdn.replace(regex, phone_code);
    regex = new RegExp(`^${phone_code}`,"i");
    if (regex.test(msisdn)) {
        msisdn = `${msisdn.substr(phone_code.length)}`;
    }
    if(!leading_zero){
        msisdn = msisdn.replace(/^0+/, '');
    }
    msisdn = `${phone_code}${msisdn}`;
	if(plus){
        msisdn = `+${msisdn}`;
	}
    return msisdn;
}

console.log(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("08030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("8030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234803000kddskdskf0000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234000000080 3000 00 00","+234")); // +2348030000000
console.log(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")); // +2348030000000