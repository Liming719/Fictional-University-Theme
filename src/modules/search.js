// import $ from 'jquery';

// class Search{
    
//     constructor(){
//         this.SeachingAreaInit();
//         //alert("Test for search");
//         this.OpenButton = $(".js-search-trigger");
//         this.CloseButton = $(".search-overlay__close");
//         this.SearchOverLay = $(".search-overlay");
//         this.SearchField = $("#search-term");
//         this.SearchResults = $("#search-overlay__results");        

//         this.IsOverlayOpen = false;
//         this.IsSpinnerVisable = false;
//         this.OldSearchFieldValue;
//         this.TypingTimer = "";

//         this.events();
//     }
    
//     events(){
//         //alert("search js event register");

//         this.OpenButton.on("click",this.OpenOverlay.bind(this));
//         this.CloseButton.on("click",this.CloseOverlay.bind(this));
//         $(document).on("keydown", this.KeyPressDispatcher.bind(this));
//         this.SearchField.on("keyup", this.TypingSearchKeyword.bind(this));
//     }

//     TypingSearchKeyword(event){
        
//         if(this.OldSearchFieldValue === this.SearchField.val())
//             return;
        
//         if(!this.SearchField.val()){
//             clearTimeout(this.TypingTimer);
//             this.SearchResults.html('');
//             this.IsSpinnerVisable = false;
//             return;
//         }

//         clearTimeout(this.TypingTimer);
//         if(this.IsSpinnerVisable == false)
//             this.SearchResults.html('<div class="spinner-loader"></div>');

//         this.IsSpinnerVisable = true;
//         this.TypingTimer = setTimeout(this.SearchingTarget.bind(this), 800);
//         this.OldSearchFieldValue = this.SearchField.val();
//     }

//     SearchingTarget(){
//         //console.log("Here is a timeout test.");
//         this.IsSpinnerVisable = false;

//         $.getJSON(`${window.location.origin}/wp-json/university/v1/search?val=${this.SearchField.val()}`, 
//         results => {
//             console.log(results);
//             this.SearchResults.html(`
//               <div class="row">
//                 <div class="one-third">
//                   <h2 class="search-overlay__section-title">General Information</h2>
//                   ${results.GeneralInfo.length ? '<ul class="link-list min-list">' : ""}
//                     ${results.GeneralInfo.map(item => `<li><a href="${item.link}">${item.title}</a> ${item.postType == "post" ? `by ${item.authorName}` : ""}</li>`).join("")}
//                   ${results.GeneralInfo.length ? "</ul>" : ""}
//                 </div>
//                 <div class="one-third">
//                   <h2 class="search-overlay__section-title">Programs</h2>
//                   ${results.program.length ? '<ul class="link-list min-list">' : ``}
//                     ${results.program.map(item => `<li><a href="${item.link}">${item.title}</a></li>`).join("")}
//                   ${results.program.length ? "</ul>" : ""}
      
//                   <h2 class="search-overlay__section-title">Professors</h2>
//                   ${results.professor.length ? '<ul class="link-list min-list">' : ``}
//                     ${results.professor.map(item => `                   
//                     <li class="professor-card__list-item">
//                         <a class="professor-card" href="${item.link}">
//                             <img class="professor-card__image" src="${item.thumbnailLink}">
//                             <span class="professor-card__name">${item.title}</span>                    
//                         </a>
//                     </li>
//                     `).join("")}
//                   ${results.professor.length ? "</ul>" : ""}
//                 </div>
//                 <div class="one-third">
//                   <h2 class="search-overlay__section-title">Campuses</h2>
//                   ${results.campus.length ? '<ul class="link-list min-list">' : ``}
//                     ${results.campus.map(item => `<li><a href="${item.link}">${item.title}</a></li>`).join("")}
//                   ${results.campus.length ? "</ul>" : ""}
      
//                   <h2 class="search-overlay__section-title">Events</h2>
//                   ${results.event.length ? '<ul class="link-list min-list">' : ``}
//                     ${results.event.map(item => `
//                     <li><a href="${item.link}">${item.title}</a></li>
//                     <div class="event-summary">
//                       <a class="event-summary__date event-summary__date--beige t-center" href="${item.link}">
//                         <span class="event-summary__month">${item.eventMonth}</span>
//                         <span class="event-summary__day">${item.eventDate}</span>
//                       </a>
//                       <div class="event-summary__content">
//                         <h5 class="event-summary__title headline headline--tiny"><a href="${item.link}">${item.title}</a></h5>
//                         <p>${item.excerpt}<a href="${item.link}" class="nu gray">Read more</a></p>
//                       </div>     
//                     </div>
//                     `).join("")}
//                   ${results.event.length ? "</ul>" : ""}
//                 </div>
//               </div>
//             `)})
//             .fail(()=>{
//                 this.SearchResults.html('<p>Unexpected Eroor, please ty again, or contact us.</p>');
//            })

//         //$.getJSON(`${window.location.origin}/wp-json/university/v1/search?val=${this.SearchField.val()}`)
//         // $.when(
//         //     $.getJSON(`${window.location.origin}/wp-json/university/v1/search?val=${this.SearchField.val()}`)
//         // ).then((posts)=>{
//         //     console.log(posts);
//         //     let FinalResults = posts['professor'].concat(posts['program']).concat(posts['event']);
//         //     this.SearchResults.html(`
//         //         <h2 class="search-overlay__section-title">General Info</h2>                
//         //         ${FinalResults.length ? '<ul class="link-list min-list">' : '<p> No Results</p>'}
//         //             ${FinalResults.map(item=>`<li><a href="${item.link}">${item.title}</a></li>`).join('')}                    
//         //         ${FinalResults.length ? '</ul>' : ''}
//         //     `);
//         // },
//         // ()=>{
//         //     this.SearchResults.html('<p>Unexpected Eroor, please ty again, or contact us.</p>');
//         // });
//     }

//     KeyPressDispatcher(event){ 
//         const key = event.key.toUpperCase();
//         //console.log(key);
//         if(key==="S"){
//             this.OpenOverlay();
//             return;
//         }

//         if(key==="ESCAPE"){
//             this.CloseOverlay();
//             return;
//         }
//     }

//     OpenOverlay(){
//         if(this.IsOverlayOpen)
//             return;
        
//         if($("input,textarea").is(':focus'))
//             return;
//         //console.log("search js open overlay");        
//         this.SearchField.val('');
//         this.SearchOverLay.addClass("search-overlay--active");
//         $("body").addClass("body-no-scroll");       
//         this.IsOverlayOpen = true;
//         setTimeout(() => this.SearchField.trigger("focus"), 300);
//     }

//     CloseOverlay(){
//         if(!this.IsOverlayOpen)
//             return;
        
//         //console.log("search js close overlay");       
//         this.SearchField.trigger("blur"); 
//         this.SearchOverLay.removeClass("search-overlay--active");
//         $("body").removeClass("body-no-scroll");
        
//         this.IsOverlayOpen=false;
//     }

//     SeachingAreaInit(){
//         $("body").append(`
//         <div class="search-overlay">
//           <div class="search-overlay__top">
//             <div class="container">
//               <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
//               <input type="text" class="search-term" name="search-term" id="search-term" placeholder="Typing you want to search." autocomplete="off" autofocus >
//               <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
//             </div>
//           </div>
//           <div class="container">
//             <div id="search-overlay__results">

//             </div>
//           </div>
//         </div>
//         `);
//     } 
// }

// export default Search

import axios from "axios"

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML()
    this.resultsDiv = document.querySelector("#search-overlay__results")
    this.openButton = document.querySelectorAll(".js-search-trigger")
    this.closeButton = document.querySelector(".search-overlay__close")
    this.searchOverlay = document.querySelector(".search-overlay")
    this.searchField = document.querySelector("#search-term")
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
    this.events()
  }

  // 2. events
  events() {
    this.openButton.forEach(el => {
      el.addEventListener("click", e => {
        e.preventDefault()
        this.openOverlay()
      })
    })

    this.closeButton.addEventListener("click", () => this.closeOverlay())
    document.addEventListener("keydown", e => this.keyPressDispatcher(e))
    this.searchField.addEventListener("keyup", () => this.typingLogic())
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer)

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>'
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.innerHTML = ""
        this.isSpinnerVisible = false
      }
    }

    this.previousValue = this.searchField.value
  }

  async getResults() {
    try {
      const response = await axios.get(window.location.origin + "/wp-json/university/v1/search?val=" + this.searchField.value)
      const results = response.data
      this.resultsDiv.innerHTML = `
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${results.GeneralInfo.length ? '<ul class="link-list min-list">' : "<p>No general information matches that search.</p>"}
              ${results.GeneralInfo.map(item => `<li><a href="${item.link}">${item.title}</a> ${item.postType == "post" ? `by ${item.authorName}` : ""}</li>`).join("")}
            ${results.GeneralInfo.length ? "</ul>" : ""}
          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Programs</h2>
            ${results.program.length ? '<ul class="link-list min-list">' : `<p>No programs match that search. <a href="${window.location.origin}/programs">View all programs</a></p>`}
              ${results.program.map(item => `<li><a href="${item.link}">${item.title}</a></li>`).join("")}
            ${results.program.length ? "</ul>" : ""}

            <h2 class="search-overlay__section-title">Professors</h2>
            ${results.professor.length ? '<ul class="professor-cards">' : `<p>No professors match that search.</p>`}
              ${results.professor
          .map(
            item => `
                <li class="professor-card__list-item">
                  <a class="professor-card" href="${item.link}">
                    <img class="professor-card__image" src="${item.thumbnailLink}">
                    <span class="professor-card__name">${item.title}</span>
                  </a>
                </li>
              `
          )
          .join("")}
            ${results.professor.length ? "</ul>" : ""}

          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Campuses</h2>
            ${results.campus.length ? '<ul class="link-list min-list">' : `<p>No campuses match that search. <a href="${window.location.origin}/campuses">View all campuses</a></p>`}
              ${results.campus.map(item => `<li><a href="${item.link}">${item.title}</a></li>`).join("")}
            ${results.campus.length ? "</ul>" : ""}

            <h2 class="search-overlay__section-title">Events</h2>
            ${results.event.length ? "" : `<p>No events match that search. <a href="${window.location.origin}/events">View all events</a></p>`}
              ${results.event
          .map(
            item => `
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="${item.link}">
                    <span class="event-summary__month">${item.eventMonth}</span>
                    <span class="event-summary__day">${item.eventDay}</span>  
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.link}">${item.title}</a></h5>
                    <p>${item.excerpt} <a href="${item.link}" class="nu gray">Learn more</a></p>
                  </div>
                </div>
              `
          )
          .join("")}

          </div>
        </div>
      `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }

  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && document.activeElement.tagName != "INPUT" && document.activeElement.tagName != "TEXTAREA") {
      this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {    
    this.searchOverlay.classList.add("search-overlay--active")
    document.body.classList.add("body-no-scroll")
    this.searchField.value = ""
    setTimeout(() => this.searchField.focus(), 301)
    //console.log("our open method just ran!")
    this.isOverlayOpen = true
    return false
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active")
    document.body.classList.remove("body-no-scroll")
    //console.log("our close method just ran!")
    this.searchField.blur()
    this.isOverlayOpen = false
  }

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>

      </div>
    `
    )
  }
}

export default Search
