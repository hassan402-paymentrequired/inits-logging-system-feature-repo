const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
    const li = item.parentElement;

    item.addEventListener("click", () => {
        allSideMenu.forEach((i) => {
            i.parentElement.classList.remove("active");
        });
        li.classList.add("active");
    });
});

const sidebar = document.getElementById("sidebar");

// const switchMode = document.getElementById("switch-mode");

// switchMode.addEventListener("change", () => {
//     if (this.checked) {
//         document.body.classList.add("dark");
//     } else {
//         document.body.classList.remove("dark");
//     }
// });

const form = document.getElementById("form");
const submitButton = document.getElementById("submitButton");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    // Show loading state
    submitButton.disabled = true;
    submitButton.innerHTML = `
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      Loading...`;

    // Submit the form after displaying loading state
    form.submit();
});

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const entriesPerPage = document.getElementById("entriesPerPage");
    const tableBody = document.getElementById("tableBody");
    const paginationLinks = document.getElementById("paginationLinks");

    // Function to fetch data based on search query and page limit
    function fetchData(page = 1) {
        const searchQuery = searchInput.value;
        const perPage = entriesPerPage.value;

        // Fetch data from the server using fetch API
        fetch(
            `/your-data-url?page=${page}&search=${encodeURIComponent(
                searchQuery
            )}&per_page=${perPage}`
        )
            .then((response) => response.json())
            .then((data) => {
                updateTable(data.data); // Update the table rows
                updatePagination(data.links); // Update pagination links
            });
    }

    // Update the table with fetched data
    function updateTable(items) {
        tableBody.innerHTML = ""; // Clear existing rows
        items.forEach((item) => {
            let row = `<tr>
                <td>${item.visitor ? item.visitor.name : item.name}</td>
                <td>${
                    item.visitor ? item.visitor.phone_number : item.phone_number
                }</td>
                <td>${
                    item.visitor
                        ? item.visitor.purpose_of_visit
                        : item.department
                }</td>
                <td>${item.staff_id ? item.staff_id : ""}</td>
            </tr>`;
            tableBody.insertAdjacentHTML("beforeend", row); // Add new rows
        });
    }

    // Update pagination links
    function updatePagination(links) {
        paginationLinks.innerHTML = links; // Update pagination links
    }

    // Event listeners for search input and entries per page
    searchInput.addEventListener("input", function () {
        fetchData(); // Fetch new data when input changes
    });

    entriesPerPage.addEventListener("change", function () {
        fetchData(); // Fetch new data when entries per page changes
    });

    // Initial data fetch
    fetchData(); // Load initial data on page load
});

// Initialize Bootstrap tooltips
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
