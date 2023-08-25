const addCategoryButton = document.querySelector('.add-category-button')
const addCategoryForm = document.querySelector('.add-category-form')
const categoryForm = document.querySelector('.category-form')
const closeCategoryForm = document.querySelector('.close-category-form')

const addBookmarkButton = document.querySelector('.add-bookmark-button')
const addBookmarkForm = document.querySelector('.add-bookmark-form')
const bookmarkForm = document.querySelector('.bookmark-form')
const closeBookmarkForm = document.querySelector('.close-bookmark-form')

const error = document.querySelector('.error')
const errorTwo = document.querySelector('.error-two')

const bookmarksList = document.querySelector('.bookmarks-list')

window.onload = () => {
  if(!localStorage.getItem("categories")) {
    bookmarksList.innerHTML += '<p class="message">No Categories</p>'
  } else if(!localStorage.getItem("bookmarks")) {
    bookmarksList.innerHTML += '<p class="message">No Bookmarks</p>'
  } else {
    getBookmarks()
  }
}

addCategoryButton.addEventListener("click", () => {
  addCategoryForm.style.display = "block"
})

closeCategoryForm.addEventListener("click", () => {
  addCategoryForm.style.display = "none"
})

addBookmarkButton.addEventListener("click", () => {
  addBookmarkForm.style.display = "block"
  getCategories()
})

closeBookmarkForm.addEventListener("click", () => {
  addBookmarkForm.style.display = "none"
})

window.addEventListener("click", (e) => {
  if(e.target == addCategoryForm || e.target == addBookmarkForm) {
    addCategoryForm.style.display = "none"
    addBookmarkForm.style.display = "none"
  }
})

categoryForm.addEventListener("submit", (e) => {
  e.preventDefault()

  let categoryName = document.querySelector('.category-name').value

  if(!categoryName) {
    error.innerHTML += "Enter a category name"

    return false
  }

  let category = {
    categoryName: categoryName
  }

  if(localStorage.getItem("categories") === null) {
    let categories = []

    categories.push(category)

    localStorage.setItem("categories", JSON.stringify(categories))
  } else {
    let categories = JSON.parse(localStorage.getItem("categories"))

    categories.push(category)

    localStorage.setItem("categories", JSON.stringify(categories))
  }

  location.reload()
})

bookmarkForm.addEventListener("submit", (e) => {
  e.preventDefault()

  let name = document.querySelector('.name').value
  let url = document.querySelector('.url').value
  let category = document.querySelector('.category').value

  if(!validate(name, url)) {
    return false
  }

  let bookmark = {
    name: name,
    url: url,
    category: category
  }

  if(localStorage.getItem("bookmarks") === null) {
    let bookmarks = []

    bookmarks.push(bookmark)

    localStorage.setItem("bookmarks", JSON.stringify(bookmarks))
  } else {
    let bookmarks = JSON.parse(localStorage.getItem("bookmarks"))

    bookmarks.push(bookmark)

    localStorage.setItem("bookmarks", JSON.stringify(bookmarks))
  }

  location.reload()
})

let getCategories = (function() {
  let executed = false

  return function() {
    if(!executed) {
      executed = true

      let categories = JSON.parse(localStorage.getItem("categories"))
      let categoriesList = document.querySelector('.category')

      for(let i = 0; i < categories.length; i++) {
        let category = categories[i].categoryName
        categoriesList.innerHTML += '<option>' + category + '</option>'
      }
    }
  }
})()

function getBookmarks() {
  let categories = JSON.parse(localStorage.getItem("categories"))
  let bookmarks = JSON.parse(localStorage.getItem("bookmarks"))

  if(categories == false) {
    bookmarksList.innerHTML += '<p class="message">No Bookmarks</p>'
  }

  for(let i = 0; i < categories.length; i++) {
    let category = categories[i].categoryName

    let box = document.createElement('div')
    box.className = 'box'
    box.innerHTML += 
      '<h2>' +
        category +
        '<a class="delete-category" onclick="deleteCategory(\'' + category + '\')" href="#">&times;</a>' +
      '</h2>'
    
    for(let i = 0; i < bookmarks.length; i++) {
      let name = bookmarks[i].name
      let url = bookmarks[i].url
      let cat = bookmarks[i].category

      if(cat == category) {
        box.innerHTML +=
          '<div class="bookmark">' +
            '<p>' +
              '<a target="_blank" href="' + url + '">' + name + '</a>' +
              '<a class="delete-bookmark" onclick="deleteBookmark(\'' + url + '\')" href="#">&times;</a>' +
            '</p>' +
          '</div>'
      }
    }

    bookmarksList.appendChild(box)
  }
}

function deleteCategory(category) {
  let categories = JSON.parse(localStorage.getItem("categories"))

  for(let i = 0; i < categories.length; i++) {
    if(categories[i].categoryName == category) {
      categories.splice(i, 1)
    }
  }

  localStorage.setItem("categories", JSON.stringify(categories))

  location.reload()
}

function deleteBookmark(url) {
  let bookmarks = JSON.parse(localStorage.getItem("bookmarks"))

  for(let i = 0; i < bookmarks.length; i++) {
    if(bookmarks[i].url == url) {
      bookmarks.splice(i, 1)
    }
  }

  localStorage.setItem("bookmarks", JSON.stringify(bookmarks))

  location.reload()
}

function validate(name, url) {
  if(!name || !url) {
    errorTwo.innerHTML += "Fill in both fields <br>"

    return false
  }

  let expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi
  let regex = new RegExp(expression)

  if(!url.match(regex)) {
    errorTwo.innerHTML += "Enter a valid URL"

    return false
  }

  return true
}