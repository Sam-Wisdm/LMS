


function setCourseNavBar(){
    let courseNavBar = document.getElementById('courseNavBar');
    let courseNavBarCont = ``;
    if(lessonArr.length) {
        for(let i=0; i<lessonArr.length; i++) {
            let lessObj = lessonArr[i];
            courseNavBarCont += `
                <div class="section">
                    <a href="#">
                        <div class="sectionTitle" id="${lessObj.lesson_id}" onclick="setCourseNavContent(${lessObj.lesson_id})">
                            <h4>${lessObj.lesson_name}</h4>
                        </div>  
                        <hr>
                    </a>                  
                </div>
            `;
        }
    }
    courseNavBar.innerHTML = courseNavBarCont;
}
setCourseNavBar();

function setCourseNavContent(lessonID){
    // console.log(lessonID)
    let navTitle = document.getElementById(lessonID);
    let navTitleClass = document.getElementsByClassName('sectionTitle');
    for(let i=0; i<navTitleClass.length; i++) {
        navTitleClass[i].style.color = "rgb(156, 151, 151)";
    }
    navTitle.style.color = "black";
    let courseNavVid = document.getElementById('courseNav-vid');
    let lessonDescEle = document.getElementById('courseNav-overview');
    let lessonDesc = ``;
    let courseNavVideo = ``;
    let lessObj;
    for(let i=0; i<lessonArr.length; i++){
        if(lessonArr[i].lesson_id == lessonID) {
            lessObj = lessonArr[i];
            break;
        }
    }
    if(lessonArr.length && lessObj) {
        courseNavVideo = `
            <div class="courseTitle"><h2>${courseRow.course_title}</h2></div>
            <div class="video" id="video${lessObj.lesson_id}">
                <video width="800" height="550" controls>
                    <source src="${lessObj.lesson_link}" type="video/mp4">
                    <source src="${lessObj.lesson_link}" type="video/ogg"> 
                    Your browser does not support the video tag.
                </video>
                <!-- <p>${lessObj.lesson_link}</p> -->
            </div>
        `;
        lessonDesc = `
            <div class="lessonDesc" id="lessonDesc">
                <h4>${lessObj.lesson_name}</h4>
                <p>${lessObj.lesson_desc}</p>
            </div>
        `;
    }
    courseNavVideo += `
        <div id="next-prev-btn">
            <div class="courseNav-btn" onclick="prev(${lessObj.lesson_id})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="40" fill="white">
                    <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8592;</text>
                </svg>
            </div>
            <div class="courseNav-btn" onclick="next(${lessObj.lesson_id})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="40" fill="white">
                    <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8594;</text>
                </svg>
            </div>
        </div>
    `;
    courseNavVid.innerHTML = courseNavVideo;
    lessonDescEle.innerHTML = lessonDesc;
}
// setCourseNavContent();

function prev(lid){
    let idx = 0;
    for(let i=0; i<lessonArr.length; i++){
        if(lessonArr[i].lesson_id == lid) {
            idx = i;
            break;
        }
    }
    if(idx > 0) {
        let prev_lid = lessonArr[idx-1].lesson_id;
        setCourseNavContent(prev_lid);
    }
}

function next(lid){
    let idx = lessonArr.length-1;
    for(let i=0; i<lessonArr.length; i++){
        if(lessonArr[i].lesson_id == lid) {
            idx = i;
            break;
        }
    }
    if(idx < lessonArr.length-1) {
        let next_lid = lessonArr[idx+1].lesson_id;
        setCourseNavContent(next_lid);
    }
}