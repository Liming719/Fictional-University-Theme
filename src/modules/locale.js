import axios from "axios"

class Locale {
    constructor(){
        this.languageList = document.querySelector("#LanguageList")
        this.events()
    }
    events() {
        this.languageList.addEventListener("change",()=>this.switchLocale())
    }
    async switchLocale(){        
        console.log(`Chane language to ${this.languageList.value}`)
        var res = await axios.get(window.location.origin + "/wp-json/university/v1/language?lan=" + this.languageList.value) 
    }
}

export default Locale
