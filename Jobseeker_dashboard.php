<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PESO Connect | Find Jobs</title>

  <style>
    :root {
      --navy: #0A2342;
      --gold: #FFC107;
      --blue: #EAF6FF;
      --text: #263646;
      --muted: #687888;
      --line: #DCE5EC;
      --green: #188754;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background: #F4F8FB;
      color: var(--text);
    }

    .topbar {
      background: white;
      min-height: 70px;
      padding: 0 7%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--line);
    }

    .logo {
      color: var(--navy);
      font-size: 22px;
      font-weight: bold;
    }

    .nav {
      display: flex;
      gap: 25px;
      align-items: center;
    }

    .nav a {
      color: #536171;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
    }

    .nav a.active {
      color: var(--navy);
    }

    .avatar {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      background: #FFE8A0;
      color: var(--navy);
      font-size: 13px;
      font-weight: bold;
    }

    main {
      max-width: 1100px;
      margin: auto;
      padding: 38px 20px 60px;
    }

    .heading h1 {
      color: var(--navy);
      margin-bottom: 8px;
    }

    .heading p {
      color: var(--muted);
      margin-bottom: 25px;
    }

    .search-box {
      display: flex;
      gap: 10px;
      background: white;
      padding: 15px;
      border: 1px solid var(--line);
      border-radius: 12px;
      margin-bottom: 25px;
    }

    .search-box input {
      flex: 1;
      border: 1px solid #C9D6E0;
      border-radius: 8px;
      padding: 12px;
      outline: none;
      font-size: 14px;
    }

    .search-box button {
      border: none;
      border-radius: 8px;
      padding: 12px 22px;
      cursor: pointer;
      background: var(--gold);
      color: var(--navy);
      font-weight: bold;
    }

    .layout {
      display: grid;
      grid-template-columns: 230px 1fr;
      gap: 25px;
    }

    .filter,
    .job-card {
      background: white;
      border: 1px solid var(--line);
      border-radius: 12px;
    }

    .filter {
      padding: 20px;
      height: fit-content;
    }

    .filter h3 {
      color: var(--navy);
      margin-bottom: 18px;
    }

    .filter label {
      display: block;
      margin: 14px 0 6px;
      font-size: 13px;
      font-weight: bold;
      color: #46596A;
    }

    .filter select {
      width: 100%;
      padding: 10px;
      border: 1px solid #C9D6E0;
      border-radius: 7px;
      background: white;
    }

    .job-list {
      display: grid;
      gap: 16px;
    }

    .job-card {
      padding: 22px;
    }

    .job-top {
      display: flex;
      justify-content: space-between;
      gap: 15px;
    }

    .job-card h2 {
      color: var(--navy);
      font-size: 19px;
      margin-bottom: 7px;
    }

    .company {
      font-weight: bold;
      color: #485A6A;
      margin-bottom: 10px;
    }

    .details {
      color: var(--muted);
      font-size: 14px;
      line-height: 1.7;
    }

    .approved {
      height: fit-content;
      white-space: nowrap;
      background: #E5F7ED;
      color: var(--green);
      font-size: 12px;
      font-weight: bold;
      padding: 7px 10px;
      border-radius: 20px;
    }

    .job-footer {
      margin-top: 18px;
      padding-top: 15px;
      border-top: 1px solid #EDF1F4;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .posted {
      color: var(--muted);
      font-size: 12px;
    }

    .apply-btn {
      background: var(--gold);
      color: var(--navy);
      border: none;
      border-radius: 7px;
      padding: 10px 16px;
      font-weight: bold;
      cursor: pointer;
    }

    .apply-btn:hover,
    .search-box button:hover {
      background: #E0AA00;
    }

    @media (max-width: 768px) {
      .topbar {
        padding: 15px 20px;
      }

      .nav a {
        display: none;
      }

      .layout {
        grid-template-columns: 1fr;
      }

      .search-box {
        flex-direction: column;
      }

      .job-top {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <header class="topbar">
    <div class="logo">PESO Connect Mandaluyong</div>

    <nav class="nav">
      <a href="jobseeker-dashboard.html" class="active">Find Jobs</a>
      <a href="my-applications.html">My Applications</a>
      <a href="my-profile.html">My Profile</a>
      <div class="avatar">JD</div>
    </nav>
  </header>

  <main>
    <section class="heading">
      <h1>Find your next job</h1>
      <p>Browse job opportunities approved by the PESO / Government administrator.</p>
    </section>

    <section class="search-box">
      <input type="text" id="searchInput" placeholder="Search job title, company, or skill">
      <button onclick="searchJobs()">Search Jobs</button>
    </section>

    <div class="layout">
      <aside class="filter">
        <h3>Filter Jobs</h3>

        <label>Job Type</label>
        <select>
          <option>All Job Types</option>
          <option>Full-time</option>
          <option>Part-time</option>
          <option>Contract</option>
          <option>Internship</option>
        </select>

        <label>Work Location</label>
        <select>
          <option>All Barangays</option>
          <option>Addition Hills</option>
          <option>Highway Hills</option>
          <option>Poblacion</option>
          <option>Plainview</option>
          <option>Wack-Wack Greenhills</option>
        </select>
      </aside>

      <section class="job-list" id="jobList">
        <article class="job-card">
          <div class="job-top">
            <div>
              <h2>Customer Service Representative</h2>
              <p class="company">ABC Business Solutions</p>
              <p class="details">
                📍 Highway Hills, Mandaluyong City<br>
                💼 Full-time<br>
                💰 ₱18,000–₱22,000 per month
              </p>
            </div>
            <span class="approved">✓ Government Approved</span>
          </div>

          <div class="job-footer">
            <span class="posted">Posted today</span>
            <button
  class="apply-btn"
  onclick="openApplication('Administrative Assistant', 'Mandaluyong Office Supplies Inc.')">
  Apply Now
</button>
          </div>
        </article>

        <article class="job-card">
          <div class="job-top">
            <div>
              <h2>Administrative Assistant</h2>
              <p class="company">Mandaluyong Office Supplies Inc.</p>
              <p class="details">
                📍 Addition Hills, Mandaluyong City<br>
                💼 Full-time<br>
                💰 ₱16,000–₱20,000 per month
              </p>
            </div>
            <span class="approved">✓ Government Approved</span>
          </div>

          <div class="job-footer">
            <span class="posted">Posted 2 days ago</span>
            <button
  class="apply-btn"
  onclick="openApplication('Administrative Assistant', 'Mandaluyong Office Supplies Inc.')">
  Apply Now
</button>
          </div>
        </article>

        <article class="job-card">
          <div class="job-top">
            <div>
              <h2>Sales Associate</h2>
              <p class="company">Metro Retail Corporation</p>
              <p class="details">
                📍 Wack-Wack Greenhills, Mandaluyong City<br>
                💼 Full-time<br>
                💰 ₱15,000–₱18,000 per month
              </p>
            </div>
            <span class="approved">✓ Government Approved</span>
          </div>

          <div class="job-footer">
            <span class="posted">Posted 3 days ago</span>
            <button
  class="apply-btn"
  onclick="openApplication('Sales Associate', 'Metro Retail Corporation')">
  Apply Now
</button>
          </div>
        </article>
      </section>
    </div>
  </main>

  <script>
    function openApplication(jobTitle, companyName) {
  window.location.href =
    "job-application.html?job=" + encodeURIComponent(jobTitle) +
    "&company=" + encodeURIComponent(companyName);
}

    function searchJobs() {
      const searchText = document.getElementById("searchInput").value.toLowerCase();
      const jobs = document.querySelectorAll(".job-card");

      jobs.forEach(function(job) {
        const jobText = job.innerText.toLowerCase();

        if (jobText.includes(searchText)) {
          job.style.display = "block";
        } else {
          job.style.display = "none";
        }
      });
    }
  </script>
</body>
</html>