# Misidn Sanitizer

## Introduction

This is a light weight function which helps you clean and remove invlaid characters from phone number also taken into account the country international phone code using regular expressions

Key thing taken care of

* append the phone to the msisdn
* take care of leading zeros in from of numbers
* remove exccess leading zeros
* remove invalid character
* remove white spaces
* remove repeating phone code

**Pyhton**, **PHP**, **Dart** and **Javascript**

## Python

```python

import re

def msisdn_sanitizer(msisdn, phone_code, leading_zero=False, plus=True) :
    msisdn = msisdn.strip()
    msisdn = msisdn.replace('+', '')

    pattern = re.compile("[^0-9]")
    msisdn = pattern.sub("", msisdn)

    phone_code = phone_code.replace('+', '')

    pattern = re.compile(r"^("+phone_code+")+")
    msisdn = pattern.sub(phone_code, msisdn)

    regex = "^" + phone_code
    if re.match(regex, msisdn):
        msisdn = msisdn[len(phone_code):]

    if leading_zero is False:
        pattern = re.compile("^0+")
        msisdn = pattern.sub("", msisdn)

    msisdn = phone_code + msisdn
    if plus:
        msisdn = "+" + msisdn
    return msisdn

# Use cases
print(msisdn_sanitizer("+2348030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("+2348030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("08030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("8030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234803000kddskdskf0000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234000000080 3000 00 00","+234")) # +2348030000000
print(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")) # +2348030000000
```

## PHP

```php

function msisdn_sanitizer($msisdn, $phone_code, $leading_zero=false, $plus=true){
    $msisdn = trim($msisdn);
    $msisdn = str_replace('+', '', $msisdn);
    $msisdn = preg_replace("/[^0-9]/", '', $msisdn);
    $phone_code = str_replace('+', '', $phone_code);
    $regex = "/^(${phone_code})+/i";
    $msisdn = preg_replace($regex, $phone_code, $msisdn);
    $regex = "/^$phone_code/i";
    if(preg_match($regex,$msisdn) == true){
        $msisdn = substr($msisdn, strlen($phone_code));
    }
    if(!$leading_zero){
        $msisdn = preg_replace("/^0+/", '', $msisdn);
    }
    $msisdn = "${phone_code}${msisdn}";
    if(!$plus == false){
        if(strpos($msisdn,'+') == false)
            $msisdn = "+${msisdn}";
    }
    return $msisdn;
}
# Use cases
var_dump(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000s 
var_dump(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("08030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("8030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234803000kddskdskf0000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234000000080 3000 00 00","+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")); // +2348030000000
```

## Javascript

```js
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
// Use cases
console.log(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("08030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("8030000000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234803000kddskdskf0000", "+234")); // +2348030000000
console.log(msisdn_sanitizer("+234000000080 3000 00 00","+234")); // +2348030000000
console.log(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")); // +2348030000000
```

## Dart

```dart
String msisdn_sanitizer(String msisdn, String phone_code, {bool leading_zero = false, bool plus = true}) {
    msisdn = msisdn.trim();
    msisdn = msisdn.replaceAll("+", "");
    msisdn = msisdn.replaceAll(RegExp(r'[^0-9]'), '');
    phone_code = phone_code.replaceAll('+', '');
    var regex = RegExp("^($phone_code)+");
    msisdn = msisdn.replaceAll(regex, phone_code);
    if(regex.hasMatch(msisdn)) {
        msisdn = msisdn.substring(phone_code.length);
    }
    if(!leading_zero) {
        msisdn = msisdn.replaceAll(RegExp(r'^0+'), '');
    }
    msisdn = "$phone_code$msisdn";
    if(plus){
        msisdn = "+$msisdn";
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
```


