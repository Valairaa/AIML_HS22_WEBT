// JavaScript Dokument für Online-Shop- und Formularvalidierung via vue.js

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
    })
    return cookie[cookieName];
  }

function checkExistanceOfCookies() {
    if (getCookie("filterAlles") == ("true" || "false")
        || getCookie("filterVegetarisch") == ("true" || "false")
        || getCookie("filterFleisch") == ("true" || "false")
        || getCookie("filterKaese") == ("true" || "false")) {
        return true;
    }
}

Vue.createApp({
    data(){
        return {
            user: {
                name: "",
                mail: "",
                adresse: "",
                plz: "",
                ort: ""
            } 
        }
    },
    methods: {
        nameIsValid: function () {
            regName = /^[A-Za-z][A-Za-zäöüÄÖÜ ]{4,29}$/;
            if (this.user.name != "") {
                return !(regName.test(this.user.name));
            }
        },
        mailIsValid: function () {
            regMail = /^[^@]+@\w+(\.\w+)+\w$/;
            if (this.user.mail != "") {
                return !(regMail.test(this.user.mail));
            }
        },
        adresseIsValid: function () {
            regAdresse = /^[A-Za-z][A-Za-zäöüÄÖÜ0-9 ]{4,29}$/;
            if (this.user.adresse != "") {
                return !(regAdresse.test(this.user.adresse));
            }
        },
        plzIsValid: function () {
            regPLZ = /^[0-9]{4}$/;
            if (this.user.plz != "") {
                return !(regPLZ.test(this.user.plz));
            }
        },
        ortIsValid: function () {
            regOrt = /^[A-Za-z][A-Za-zäöüÄÖÜ ]{4,29}$/;
            if (this.user.ort != "") {
                return !(regOrt.test(this.user.ort));
            }
        }
    }
}).mount('#benutzer');

Vue.createApp({
    data(){
        return {
            updated: "no",
            items: [
                { name: "Acquerello Reis", kosten: 9.99, anzahl: 0, img: "img/acquerello_reis.png" , filter: "reis", updated: "no"},
                { name: "Almkaese", kosten: 12.99, anzahl: 0, img: "img/almkaese.png" , filter: "kaese", updated: "no"},
                { name: "Berghonig", kosten: 19.99, anzahl: 0, img: "img/berghonig.png" , filter: "honig", updated: "no"},
                { name: "Bergkaese", kosten: 12.99, anzahl: 0, img: "img/bergkaese.png" , filter: "kaese", updated: "no"},
                { name: "Bluetenhonig", kosten: 14.99, anzahl: 0, img: "img/honig.png" , filter: "honig", updated: "no"},
                { name: "Capocollo", kosten: 19.99, anzahl: 0, img: "img/capocollo.png" , filter: "fleisch", updated: "no"},
                { name: "Gorgonzola", kosten: 12.99, anzahl: 0, img: "img/gorgonzola.png" , filter: "kaese", updated: "no"},
                { name: "Eingelegte Pilze", kosten: 9.99, anzahl: 0, img: "img/pilze_oliven.png" , filter: "pilze", updated: "no"},
                { name: "Rohschinken", kosten: 19.99, anzahl: 0, img: "img/rohschinken.png" , filter: "fleisch", updated: "no"},
                { name: "Schw. Knoblauch", kosten: 39.99, anzahl: 0, img: "img/schwarzer_knoblauch.png" , filter: "knoblauch", updated: "no"},
                { name: "Speck", kosten: 19.99, anzahl: 0, img: "img/speck.png" , filter: "fleisch" , updated: "no"},
                { name: "Trueffelpaste", kosten: 19.99, anzahl: 0, img: "img/trueffel_creme.png" , filter: "pilze", updated: "no"},
            ]
        }
    },
    methods: {
        resetAll: function() {
            for (let i = 0; i < this.items.length; ++i) {
                if (this.items[i].anzahl > 0) {
                    this.items[i].anzahl = 0
                }
            }
        },
        sum: function () {
            let total = 0;
            for (let i = 0; i < this.items.length; ++i) {
                total += this.items[i].kosten * this.items[i].anzahl;
            }
            return total;
        },
        createCookie: function (cName, cValue) {
            cExpires = 60 * 60 // 1 Stunde;
            if (cValue > 0) {
                document.cookie = cName + "=" + cValue + "; max-age =" + cExpires;
            } else {
                document.cookie = cName + "=; max-age = -20000";
            }
        },
        updateCookieEasy : function (itemName) {
            return getCookie(itemName);  
        },
        filterMitCookies: function (item) {
            if (checkExistanceOfCookies() == true) {
                if (getCookie("filterAlles") == "true") {
                    return true;
                }
                if (item.filter == "fleisch" && getCookie("filterFleisch") == "true") {
                    return true;
                }
                if (item.filter == "kaese" && getCookie("filterKaese") == "true") {
                    return true;
                }
                if (item.filter != "fleisch" && getCookie("filterVegetarisch") == "true") {
                    return true;
                }
            } else {
                return true;
            }
          }
    }
}).mount('#onlineShop');