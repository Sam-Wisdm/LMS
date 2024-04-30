var pageNo = 0;
var courseArr = [];
var filterPosts = [];
// fetch('./slide.json')
//     .then(response => {
//         return response.json();
//     })
//     .then(data => {
//         courseArr = data;
//         if (document.getElementById('slider') != null) {
//             set_slide()
//         }
//         else if (document.getElementById('course-arch-cards') != null) {
//             filterPosts = courseArr;
//             setCourseArchive(0, courseArr);
//             numOfPages(courseArr, pageNo);
//             selectPageBgColor(pageNo, courseArr);
//         }
//     });

function getCourseArr() {

    $.ajax({
        url: '../controllers/ContentController.php',
        method: 'POST',
        dataType: 'json',
        data: {
            getCourseArrForRendering : true
        },
        success: function (response) {
            console.log(response);
            if(response.success){
                console.log("Course table Fetched");
                courseArr = response.courseArr;
                filterPosts = courseArr;
                console.log(courseArr)
                setCourseArchive(0, courseArr);
                numOfPages(courseArr, pageNo);
                selectPageBgColor(pageNo, courseArr);

            } else {
                console.log("Unable to Fetch Course Table");
                console.log("Errors:", response.msg);
            }
        }
    });
}
getCourseArr();

function setCourseArchive(pgidx, courseArr) {
    let courseDiv = document.getElementById('course-arch-cards');
    let courseGrid = ``;

    if (courseArr.length) {
        for (let i = pgidx * 4; i < pgidx * 4 + 4; i++) {
            if (i >= courseArr.length) break;

            courseGrid += `<div class="courseCard">
                                <div class="courseCardImg" style="background-image: url(${courseArr[i].course_img});">

                                </div>
                                <div class="courseCardContent">
                                    <h3 class="courseCardHeading">${courseArr[i].course_title}</h3>
                                    <p class="courseCardDesc">${courseArr[i].course_desc}</p>
                                    <h4 class="courseCardAuthor"><i>Author :</i> <b>${courseArr[i].course_author}</b></h4>
                                    <!-- <div class="courseCardStudEnrollCnt"><p>Total Students Enrolled : ${courseArr[i].course_stud_enroll_cnt} </p></div> -->
                                    <button class="courseCardEnroll" onclick="explore(${courseArr[i].course_id})">Explore</button>
                                </div>
                            </div>`;
        }
        courseDiv.innerHTML = courseGrid;
    }
}

function nextPg(pgidx) {
    if (pgidx + 1 < courseArr.length) {
        pageNo = pgidx + 1;
        setCourseArchive(pageNo, filterPosts);
        selectPageBgColor(pageNo, filterPosts);
    }
}

function prevPg(pgidx) {
    if (pgidx > 0) {
        pageNo = pgidx - 1;
        setCourseArchive(pageNo, filterPosts);
        selectPageBgColor(pageNo, filterPosts);
    }
}

function changePage(pgidx) {
    setCourseArchive(pgidx, filterPosts);
    selectPageBgColor(pgidx, filterPosts);
}

function numOfPages(courseArr, pgidx) {
    let total_pages = Math.ceil(courseArr.length / 4);
    let pg = ``;
    // pg += `<div id="prev-pg" onclick="prevPg(${pgidx})">
    //             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="black">
    //                 <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8592;</text>
    //             </svg>
    //         </div>`
    for (let i = 0; i < total_pages; i++) {
        pg += `<div class="pageStyle" id="page${i}" onclick="changePage(${i})">${i + 1}</div>`;
    }
    // pg += `<div id="next-pg" onclick="nextPg(${pgidx})">
    //             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="black">
    //                 <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8594;</text>
    //             </svg>
    //         </div>`
    document.getElementById('pagination').innerHTML = pg;
}

function selectPageBgColor(pgidx, courseArr) {
    if (courseArr.length > 0) {
        let selectedPage = document.getElementById(`page${pgidx}`);
        if (selectedPage) {
            console.log(selectedPage);
            selectedPage.style.backgroundColor = 'rgb(0, 153, 255)';
            selectedPage.style.color = 'azure';

            let total_pages = Math.ceil(courseArr.length / 4);
            for (let i = 0; i < total_pages; i++) {
                if (i === pgidx) continue;
                let otherPage = document.getElementById(`page${i}`);
                if (otherPage) {
                    otherPage.style.backgroundColor = 'azure';
                    otherPage.style.color = 'rgb(0, 153, 255)';
                }
            }
        } else {
            console.error(`Element with id "page${pgidx}" not found.`);
        }
    } else {
        console.error("courseArr is empty.");
    }
}

function explore(cid) {
    var courseContentURL = 'courseNav.php?cid=' + cid;
    window.location.href = courseContentURL;
}

// search 
function search() {
    let search_key = document.getElementById('searchbar').value;
    filterPosts = [];

    courseArr.forEach(item => {
        let findTitle = item.title.toLowerCase().search(search_key.toLowerCase());
        let findDesc = item.desc.toLowerCase().search(search_key.toLowerCase());
        let findAuthor = item.author.toLowerCase().search(search_key.toLowerCase());
        if ((findTitle != -1) || (findDesc != -1) || (findAuthor != -1)) {
            filterPosts.push(item);
        }
    })

    setCourseArchive(pageNo, filterPosts);
    numOfPages(filterPosts, pageNo);
    selectPageBgColor(pageNo, filterPosts);
}
