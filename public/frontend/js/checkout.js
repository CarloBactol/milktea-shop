$(document).ready(function () {
    $(".paypal").click(function (e) {
        e.preventDefault();

        var firstname = $(".firstname").val();
        var lastname = $(".lastname").val();
        var email = $(".email").val();
        var phone = $(".phone").val();
        var address = $(".address").val();
        var city = $(".city").val();
        var country = $(".country").val();
        var postal_code = $(".postal_code").val();

        if (!firstname) {
            $fname_err = "Firstname is required!";
            $(".fname_err").html("");
            $(".fname_err").html($fname_err);
        } else {
            $fname_err = "";
            $(".fname_err").html("");
        }

        if (!lastname) {
            $lname_err = "Lastname is required!";
            $(".lname_err").html("");
            $(".lname_err").html($lname_err);
        } else {
            $lname_err = "";
            $(".lname_err").html("");
        }

        if (!email) {
            $email_err = "Email is required!";
            $(".email_err").html("");
            $(".email_err").html($email_err);
        } else {
            $email_err = "";
            $(".email_err").html("");
        }

        if (!phone) {
            $phone_err = "Phone is required!";
            $(".phone_err").html("");
            $(".phone_err").html($phone_err);
        } else {
            $phone_err = "";
            $(".phone_err").html("");
        }

        if (!address) {
            $address_err = "Address is required!";
            $(".address_err").html("");
            $(".address_err").html($address_err);
        } else {
            $address_err = "";
            $(".address_err").html("");
        }

        if (!city) {
            $city_err = "City is required!";
            $(".city_err").html("");
            $(".city_err").html($city_err);
        } else {
            $city_err = "";
            $(".city_err").html("");
        }

        if (!country) {
            $country_err = "Country is required!";
            $(".country_err").html("");
            $(".country_err").html($country_err);
        } else {
            $country_err = "";
            $(".country_err").html("");
        }
        if (!postal_code) {
            $postal_code_err = "Postal code is required!";
            $(".postal_code_err").html("");
            $(".postal_code_err").html($postal_code_err);
        } else {
            $postal_code_err = "";
            $(".postal_code_err").html("");
        }

        if (
            $fname_err != "" ||
            $lname_err != "" ||
            $email_err != "" ||
            $address_err != "" ||
            $phone_err != "" ||
            $city_err != "" ||
            $country_err != "" ||
            $postal_code_err != ""
        ) {
            return false;
        } else {
            return true;
        }
    });
});
