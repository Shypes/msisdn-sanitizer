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

# Sanitizing for normal numbers
print(msisdn_sanitizer("+2348030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("+2348030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("08030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("8030000000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234803000kddskdskf0000", "+234")) # +2348030000000
print(msisdn_sanitizer("+234000000080 3000 00 00","+234")) # +2348030000000
print(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")) # +2348030000000