<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - Advanced</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5a67d8;
            --secondary: #764ba2;
            --accent: #f093fb;
            --success: #48bb78;
            --warning: #ed8936;
            --error: #f56565;
            --dark: #1a202c;
            --light: #f7fafc;
            --gray-100: #f7fafc;
            --gray-200: #edf2f7;
            --gray-300: #e2e8f0;
            --gray-400: #cbd5e0;
            --gray-600: #718096;
            --gray-800: #2d3748;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--gray-800);
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.5"><animate attributeName="opacity" values="0.5;1;0.5" dur="3s" repeatCount="indefinite"/></circle><circle cx="75" cy="75" r="1" fill="white" opacity="0.3"><animate attributeName="opacity" values="0.3;0.8;0.3" dur="4s" repeatCount="indefinite"/></circle><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.4"><animate attributeName="opacity" values="0.4;0.9;0.4" dur="2s" repeatCount="indefinite"/></circle></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-stats {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .stat-item {
            text-align: center;
            padding: 0.5rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Controls Panel */
        .controls-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .controls-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: center;
            margin-bottom: 1rem;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 1.1rem;
        }

        .filter-select, .sort-select, .per-page-select {
            padding: 1rem;
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-select:focus, .sort-select:focus, .per-page-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .view-toggles {
            display: flex;
            background: var(--gray-200);
            border-radius: 12px;
            padding: 0.25rem;
        }

        .view-btn {
            padding: 0.75rem 1rem;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--gray-600);
        }

        .view-btn.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filters-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-chip {
            padding: 0.5rem 1rem;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .filter-chip .remove {
            cursor: pointer;
            font-weight: bold;
        }

        /* Product Grid/Table */
        .products-container {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        /* Table View */
        .table-view {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .product-table th:first-child {
            border-radius: 20px 0 0 0;
        }

        .product-table th:last-child {
            border-radius: 0 20px 0 0;
        }

        .product-table td {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .product-table tr:hover td {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        .product-table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-table img:hover {
            transform: scale(1.2);
            box-shadow: var(--shadow-lg);
        }

        .product-name {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .product-category {
            font-size: 0.85rem;
            color: var(--gray-600);
            background: var(--gray-100);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            display: inline-block;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--success);
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
        }

        .action-btn.view {
            background: var(--primary);
        }

        .action-btn.edit {
            background: var(--warning);
        }

        .action-btn.delete {
            background: var(--error);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Grid View */
        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeInUp 0.6s ease-out;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .product-card .card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .product-card:hover .card-overlay {
            opacity: 1;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-800);
        }

        .card-category {
            font-size: 0.85rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .card-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--success);
            margin-bottom: 1rem;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1rem 2rem;
            border-radius: 50px;
            box-shadow: var(--shadow-lg);
        }

        .pagination a, .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--gray-600);
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .pnow {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        .pagination .nav-btn {
            width: auto;
            padding: 0 1rem;
            border-radius: 25px;
        }

        /* Loading */
        .loading {
            display: none;
            text-align: center;
            padding: 3rem;
        }

        .loading.active {
            display: block;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--gray-300);
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            animation: fadeIn 0.3s ease-out;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-close {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-400);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .controls-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .header-stats {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .product-table th, .product-table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
            
            .grid-view {
                grid-template-columns: 1fr;
            }
            
            .view-toggles {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Dark mode toggle */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            z-index: 1001;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        /* Export buttons */
        .export-buttons {
            display: flex;
            gap: 1rem;
            margin-left: auto;
        }

        .export-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .export-btn.csv {
            background: var(--success);
            color: white;
        }

        .export-btn.pdf {
            background: var(--error);
            color: white;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <button class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </button>

    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-store"></i> ProductHub
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <div class="stat-number" id="totalProducts">0</div>
                    <div class="stat-label">Sản phẩm</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="totalCategories">0</div>
                    <div class="stat-label">Danh mục</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="totalValue">0</div>
                    <div class="stat-label">Tổng giá trị</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="controls-panel">
            <div class="controls-row">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Tìm kiếm sản phẩm..." id="searchInput">
                </div>
                
                <select class="filter-select" id="categoryFilter">
                    <option value="">Tất cả danh mục</option>
                </select>
                
                <select class="sort-select" id="sortSelect">
                    <option value="name-asc">Tên A-Z</option>
                    <option value="name-desc">Tên Z-A</option>
                    <option value="price-asc">Giá thấp đến cao</option>
                    <option value="price-desc">Giá cao đến thấp</option>
                    <option value="date-desc">Mới nhất</option>
                </select>
                
                <select class="per-page-select" id="perPageSelect">
                    <option value="5">5 / trang</option>
                    <option value="10">10 / trang</option>
                    <option value="20">20 / trang</option>
                    <option value="50">50 / trang</option>
                </select>
                
                <div class="view-toggles">
                    <button class="view-btn active" data-view="table">
                        <i class="fas fa-table"></i>
                    </button>
                    <button class="view-btn" data-view="grid">
                        <i class="fas fa-th"></i>
                    </button>
                </div>
            </div>
            
            <div class="filters-row" id="activeFilters"></div>
            
            <div class="export-buttons">
                <button class="export-btn csv" onclick="exportData('csv')">
                    <i class="fas fa-file-csv"></i> CSV
                </button>
                <button class="export-btn pdf" onclick="exportData('pdf')">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>
            </div>
        </div>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Đang tải dữ liệu...</p>
        </div>

        <div class="products-container" id="productsContainer">
            <!-- Products will be loaded here -->
        </div>

        <div class="pagination-container">
            <div class="pagination" id="pagination">
                <!-- Pagination will be generated here -->
            </div>
        </div>
    </div>

    <!-- Modal for product details -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div id="modalContent">
                <!-- Product details will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Sample data (replace with your PHP data)
        const sampleProducts = [
            {
                id: 1,
                name: "iPhone 15 Pro Max",
                category: "Điện thoại",
                price: 29990000,
                image: "https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=300&h=300&fit=crop",
                description: "Điện thoại thông minh cao cấp với chip A17 Pro"
            },
            {
                id: 2,
                name: "Samsung Galaxy S24 Ultra",
                category: "Điện thoại",
                price: 26990000,
                image: "https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=300&h=300&fit=crop",
                description: "Flagship Android với S Pen tích hợp"
            },
            {
                id: 3,
                name: "MacBook Pro M3",
                category: "Laptop",
                price: 45990000,
                image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&h=300&fit=crop",
                description: "Laptop chuyên nghiệp với chip M3 mạnh mẽ"
            },
            {
                id: 4,
                name: "iPad Air",
                category: "Tablet",
                price: 16990000,
                image: "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=300&h=300&fit=crop",
                description: "Máy tính bảng đa năng cho công việc và giải trí"
            },
            {
                id: 5,
                name: "AirPods Pro",
                category: "Phụ kiện",
                price: 5990000,
                image: "https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?w=300&h=300&fit=crop",
                description: "Tai nghe không dây với khử tiếng ồn chủ động"
            },
            {
                id: 6,
                name: "Apple Watch Series 9",
                category: "Phụ kiện",
                price: 8990000,
                image: "https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=300&h=300&fit=crop",
                description: "Đồng hồ thông minh với nhiều tính năng sức khỏe"
            }
        ];

        let currentProducts = [...sampleProducts];
        let currentPage = 1;
        let itemsPerPage = 5;
        let currentView = 'table';
        let currentSort = 'name-asc';
        let currentSearch = '';
        let currentCategory = '';

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
            setupEventListeners();
            updateStats();
            renderProducts();
            renderPagination();
        });

        function initializeApp() {
            // Populate category filter
            const categories = [...new Set(sampleProducts.map(p => p.category))];
            const categoryFilter = document.getElementById('categoryFilter');
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                categoryFilter.appendChild(option);
            });
        }

        function setupEventListeners() {
            // Search
            document.getElementById('searchInput').addEventListener('input', debounce(handleSearch, 300));
            
            // Filters
            document.getElementById('categoryFilter').addEventListener('change', handleCategoryFilter);
            document.getElementById('sortSelect').addEventListener('change', handleSort);
            document.getElementById('perPageSelect').addEventListener('change', handlePerPageChange);
            
            // View toggles
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', handleViewChange);
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function handleSearch(e) {
            currentSearch = e.target.value.toLowerCase();
            currentPage = 1;
            filterAndRenderProducts();
        }

        function handleCategoryFilter(e) {
            currentCategory = e.target.value;
            currentPage = 1;
            updateActiveFilters();
            filterAndRenderProducts();
        }

        function handleSort(e) {
            currentSort = e.target.value;
            filterAndRenderProducts();
        }

        function handlePerPageChange(e) {
            itemsPerPage = parseInt(e.target.value);
            currentPage = 1;
            filterAndRenderProducts();
        }

        function handleViewChange(e) {
            document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            currentView = e.target.dataset.view;
            renderProducts();
        }

        function updateActiveFilters() {
            const filtersContainer = document.getElementById('activeFilters');
            filtersContainer.innerHTML = '';
            
            if (currentCategory) {
                const chip = document.createElement('div');
                chip.className = 'filter-chip';
                chip.innerHTML = `
                    <i class="fas fa-tag"></i>
                    ${currentCategory}
                    <span class="remove" onclick="removeFilter('category')">&times;</span>
                `;
                filtersContainer.appendChild(chip);
            }
            
            if (currentSearch) {
                const chip = document.createElement('div');
                chip.className = 'filter-chip';
                chip.innerHTML = `
                    <i class="fas fa-search"></i>
                    "${currentSearch}"
                    <span class="remove" onclick="removeFilter('search')">&times;</span>
                `;
                filtersContainer.appendChild(chip);
            }
        }

        function removeFilter(type) {
            if (type === 'category') {
                currentCategory = '';
                document.getElementById('categoryFilter').value = '';
            } else if (type === 'search') {
                currentSearch = '';
                document.getElementById('searchInput').value = '';
            }
            updateActiveFilters();
            filterAndRenderProducts();
        }

        function filterAndRenderProducts() {
            showLoading();
            
            setTimeout(() => {
                // Filter products
                let filtered = sampleProducts.filter(product => {
                    const matchesSearch = !currentSearch || 
                        product.name.toLowerCase().includes(currentSearch) ||
                        product.description.toLowerCase().includes(currentSearch);
                    const matchesCategory = !currentCategory || product.category === currentCategory;
                    return matchesSearch && matchesCategory;
                });

                // Sort products
                filtered.sort((a, b) => {
                    switch (currentSort) {
                        case 'name-asc':
                            return a.name.localeCompare(b.name);
                        case 'name-desc':
                            return b.name.localeCompare(a.name);
                        case 'price-asc':
                            return a.price - b.price;
                        case 'price-desc':
                            return b.price - a.price;
                        case 'date-desc':
                            return b.id - a.id;
                        default:
                            return 0;
                    }
                });

                currentProducts = filtered;
                hideLoading();
                renderProducts();
                renderPagination();
                updateStats();
            }, 500);
        }

        function showLoading() {
            document.getElementById('loading').classList.add('active');
            document.getElementById('productsContainer').style.opacity = '0.5';
        }

        function hideLoading() {
            document.getElementById('loading').classList.remove('active');
            document.getElementById('productsContainer').style.opacity = '1';
        }

        function renderProducts() {
            const container = document.getElementById('productsContainer');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageProducts = currentProducts.slice(startIndex, endIndex);

            if (currentView === 'table') {
                container.innerHTML = `
                    <div class="table-view">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Thông tin sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${pageProducts.map((product, index) => `
                                    <tr>
                                        <td>${startIndex + index + 1}</td>
                                        <td>
                                            <img src="${product.image}" alt="${product.name}" onclick="showProductModal(${product.id})">
                                        </td>
                                        <td>
                                            <div class="product-name">${product.name}</div>
                                            <div style="font-size: 0.9rem; color: var(--gray-600);">${product.description}</div>
                                        </td>
                                        <td>
                                            <span class="product-category">${product.category}</span>
                                        </td>
                                        <td>
                                            <div class="product-price">${formatPrice(product.price)}</div>
                                        </td>
                                        <td>
                                            <div class="product-actions">
                                                <button class="action-btn view" onclick="showProductModal(${product.id})" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" onclick="editProduct(${product.id})" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" onclick="deleteProduct(${product.id})" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;
            } else {
                container.innerHTML = `
                    <div class="grid-view">
                        ${pageProducts.map(product => `
                            <div class="product-card" onclick="showProductModal(${product.id})">
                                <div class="card-image">
                                    <img src="${product.image}" alt="${product.name}">
                                    <div class="card-overlay">
                                        <button class="action-btn view">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="event.stopPropagation(); editProduct(${product.id})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="event.stopPropagation(); deleteProduct(${product.id})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">${product.name}</h3>
                                    <p class="card-category">
                                        <i class="fas fa-tag"></i> ${product.category}
                                    </p>
                                    <div class="card-price">${formatPrice(product.price)}</div>
                                    <p style="font-size: 0.9rem; color: var(--gray-600); margin-bottom: 1rem;">${product.description}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
            }
        }

        function renderPagination() {
            const totalPages = Math.ceil(currentProducts.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            
            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let paginationHTML = '';
            
            // Previous button
            if (currentPage > 1) {
                paginationHTML += `<a href="javascript:void(0)" class="nav-btn" onclick="changePage(${currentPage - 1})">
                    <i class="fas fa-chevron-left"></i> Trước
                </a>`;
            }

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {
                paginationHTML += `<a href="javascript:void(0)" onclick="changePage(1)">1</a>`;
                if (startPage > 2) {
                    paginationHTML += `<span>...</span>`;
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i === currentPage) {
                    paginationHTML += `<span class="pnow">${i}</span>`;
                } else {
                    paginationHTML += `<a href="javascript:void(0)" onclick="changePage(${i})">${i}</a>`;
                }
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHTML += `<span>...</span>`;
                }
                paginationHTML += `<a href="javascript:void(0)" onclick="changePage(${totalPages})">${totalPages}</a>`;
            }

            // Next button
            if (currentPage < totalPages) {
                paginationHTML += `<a href="javascript:void(0)" class="nav-btn" onclick="changePage(${currentPage + 1})">
                    Sau <i class="fas fa-chevron-right"></i>
                </a>`;
            }

            pagination.innerHTML = paginationHTML;
        }

        function changePage(page) {
            currentPage = page;
            renderProducts();
            renderPagination();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateStats() {
            document.getElementById('totalProducts').textContent = currentProducts.length;
            document.getElementById('totalCategories').textContent = new Set(currentProducts.map(p => p.category)).size;
            
            const totalValue = currentProducts.reduce((sum, product) => sum + product.price, 0);
            document.getElementById('totalValue').textContent = formatPrice(totalValue, false);
        }

        function formatPrice(price, showCurrency = true) {
            const formatted = new Intl.NumberFormat('vi-VN').format(price);
            return showCurrency ? `${formatted}₫` : formatted;
        }

        function showProductModal(productId) {
            const product = sampleProducts.find(p => p.id === productId);
            if (!product) return;

            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <div style="text-align: center;">
                    <img src="${product.image}" alt="${product.name}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 1rem;">
                    <h2 style="margin-bottom: 0.5rem; color: var(--gray-800);">${product.name}</h2>
                    <p style="color: var(--gray-600); margin-bottom: 1rem;">
                        <i class="fas fa-tag"></i> ${product.category}
                    </p>
                    <p style="font-size: 1.5rem; font-weight: 700; color: var(--success); margin-bottom: 1rem;">
                        ${formatPrice(product.price)}
                    </p>
                    <p style="color: var(--gray-700); line-height: 1.6; margin-bottom: 2rem;">
                        ${product.description}
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <button class="action-btn edit" onclick="editProduct(${product.id}); closeModal();">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </button>
                        <button class="action-btn delete" onclick="deleteProduct(${product.id}); closeModal();">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            `;
            
            document.getElementById('productModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        function editProduct(productId) {
            // Implement edit functionality
            showNotification('Tính năng chỉnh sửa đang được phát triển!', 'info');
        }

        function deleteProduct(productId) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                // Implement delete functionality
                showNotification('Sản phẩm đã được xóa thành công!', 'success');
            }
        }

        function exportData(format) {
            if (format === 'csv') {
                exportToCSV();
            } else if (format === 'pdf') {
                exportToPDF();
            }
        }

        function exportToCSV() {
            const headers = ['STT', 'Tên sản phẩm', 'Danh mục', 'Giá', 'Mô tả'];
            const csvContent = [
                headers.join(','),
                ...currentProducts.map((product, index) => [
                    index + 1,
                    `"${product.name}"`,
                    `"${product.category}"`,
                    product.price,
                    `"${product.description}"`
                ].join(','))
            ].join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'danh-sach-san-pham.csv';
            link.click();
            
            showNotification('Xuất file CSV thành công!', 'success');
        }

        function exportToPDF() {
            // Implement PDF export functionality
            showNotification('Tính năng xuất PDF đang được phát triển!', 'info');
        }

        function toggleTheme() {
            const body = document.body;
            const themeToggle = document.querySelector('.theme-toggle i');
            
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                themeToggle.className = 'fas fa-moon';
            } else {
                body.classList.add('dark-mode');
                themeToggle.className = 'fas fa-sun';
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--error)' : 'var(--primary)'};
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                z-index: 1002;
                animation: slideInRight 0.3s ease-out;
                box-shadow: var(--shadow-lg);
            `;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
                ${message}
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-out';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'f':
                        e.preventDefault();
                        document.getElementById('searchInput').focus();
                        break;
                    case 'k':
                        e.preventDefault();
                        document.getElementById('searchInput').focus();
                        break;
                }
            }
            
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            
            .dark-mode {
                --gray-800: #f7fafc;
                --gray-600: #e2e8f0;
                --gray-400: #a0aec0;
                --gray-300: #4a5568;
                --gray-200: #2d3748;
                --gray-100: #1a202c;
                --light: #1a202c;
            }
            
            .dark-mode .header,
            .dark-mode .controls-panel,
            .dark-mode .table-view,
            .dark-mode .product-card {
                background: rgba(26, 32, 44, 0.95);
                color: #f7fafc;
            }
            
            .dark-mode .search-input,
            .dark-mode .filter-select,
            .dark-mode .sort-select,
            .dark-mode .per-page-select {
                background: rgba(26, 32, 44, 0.8);
                color: #f7fafc;
                border-color: #4a5568;
            }
        `;
        document.head.appendChild(style);

        // Initialize tooltips
        function initTooltips() {
            const tooltipElements = document.querySelectorAll('[title]');
            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', function(e) {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.textContent = this.getAttribute('title');
                    tooltip.style.cssText = `
                        position: absolute;
                        background: var(--dark);
                        color: white;
                        padding: 0.5rem;
                        border-radius: 6px;
                        font-size: 0.8rem;
                        z-index: 1003;
                        pointer-events: none;
                        white-space: nowrap;
                    `;
                    document.body.appendChild(tooltip);
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                    tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
                    
                    this.removeAttribute('title');
                    this.setAttribute('data-original-title', tooltip.textContent);
                });
                
                element.addEventListener('mouseleave', function() {
                    const tooltip = document.querySelector('.tooltip');
                    if (tooltip) {
                        document.body.removeChild(tooltip);
                    }
                    this.setAttribute('title', this.getAttribute('data-original-title'));
                });
            });
        }

        // Initialize tooltips on page load
        setTimeout(initTooltips, 1000);
    </script>
</body>
</html>