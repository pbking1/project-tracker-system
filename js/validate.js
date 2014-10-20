$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
);


$("#password").rules("add", { regex: "/[0-9a-zA-Z]{8,12}/" });