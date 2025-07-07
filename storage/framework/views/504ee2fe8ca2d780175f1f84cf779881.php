<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="hero-title">Bridging Government & Innovation</h1>
                    <p class="hero-subtitle">Connect, Collaborate, and Create Impact Together</p>
                    <div class="hero-buttons">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('ideas.create')); ?>" class="btn btn-primary btn-lg">Submit Your Idea</a>
                            <a href="<?php echo e(route('schemes.create')); ?>" class="btn btn-outline-light btn-lg">Post a Scheme</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg">Submit Your Idea</a>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-lg">Post a Scheme</a>
                            <p class="mt-3 text-white">Please login to submit ideas or post schemes</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?php echo e(asset('images/hero-illustration.svg')); ?>" alt="Collaboration Illustration" class="hero-image img-fluid" style="max-height: 400px; width: auto;" onerror="this.src='<?php echo e(asset('images/default-hero.svg')); ?>'">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <h2 class="section-title text-center">Platform Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-lightbulb feature-icon"></i>
                        <h3>Idea Submission</h3>
                        <p>Share your innovative ideas with government organizations</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-handshake feature-icon"></i>
                        <h3>Scheme Collaboration</h3>
                        <p>Connect with relevant schemes and funding opportunities</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h3>Track Progress</h3>
                        <p>Monitor the status of your submissions and collaborations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Impact Statistics -->
    <div class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="stat-item">
                        <h3 class="stat-number">1000+</h3>
                        <p>Ideas Submitted</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <h3 class="stat-number">500+</h3>
                        <p>Active Schemes</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <h3 class="stat-number">200+</h3>
                        <p>Successful Collaborations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <div class="container">
            <h2 class="section-title text-center">Recent Activity</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="activity-card">
                        <h3>Latest Ideas</h3>
                        <div class="activity-list">
                            <!-- This will be populated dynamically -->
                            <div class="activity-item">
                                <h4>Smart City Solutions</h4>
                                <p>Submitted by Tech Innovators Inc.</p>
                            </div>
                            <div class="activity-item">
                                <h4>Green Energy Initiative</h4>
                                <p>Submitted by Eco Solutions Ltd.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="activity-card">
                        <h3>New Schemes</h3>
                        <div class="activity-list">
                            <!-- This will be populated dynamically -->
                            <div class="activity-item">
                                <h4>Startup India 2.0</h4>
                                <p>Ministry of Commerce</p>
                            </div>
                            <div class="activity-item">
                                <h4>Digital Innovation Fund</h4>
                                <p>Ministry of Technology</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="cta-section">
        <div class="container text-center position-relative" style="z-index: 2;">
            <h2>Ready to Make an Impact?</h2>
            <p>Join our community of innovators and government organizations</p>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-light btn-lg cta-button">Get Started</a>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #1a73e8;
            --primary-dark: #0d47a1;
            --secondary-color: #4285f4;
            --gradient-start: #1a73e8;
            --gradient-end: #4285f4;
            --text-primary: #202124;
            --text-secondary: #5f6368;
            --card-bg: #FFFFFF;
            --hover-shadow: rgba(26, 115, 232, 0.1);
            --background-light: #f8f9fa;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-buttons {
            position: relative;
            z-index: 3;
        }

        .hero-buttons .btn {
            margin-right: 15px;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .hero-buttons .btn-primary {
            background: white;
            color: var(--gradient-start);
            border: none;
        }

        .hero-buttons .btn-outline-light {
            border: 2px solid white;
            background: transparent;
            color: white;
        }

        .hero-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .hero-buttons .btn-outline-light:hover {
            background: white;
            color: var(--gradient-start);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .hero-image {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: var(--background-light);
        }

        .section-title {
            margin-bottom: 50px;
            font-weight: 700;
            color: var(--text-primary);
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border-radius: 2px;
        }

        .feature-card {
            text-align: center;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 4px 6px var(--hover-shadow);
            transition: all 0.3s ease;
            border: 1px solid rgba(74, 144, 226, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px var(--hover-shadow);
        }

        .feature-icon {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        /* Stats Section */
        .stats-section {
            padding: 60px 0;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stat-item {
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Recent Activity */
        .recent-activity {
            padding: 80px 0;
            background-color: var(--background-light);
        }

        .activity-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 6px var(--hover-shadow);
            margin-bottom: 30px;
            border: 1px solid rgba(74, 144, 226, 0.1);
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px var(--hover-shadow);
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid rgba(74, 144, 226, 0.1);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
            z-index: 1;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cta-button {
            position: relative;
            z-index: 3;
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 600;
            background: white;
            color: var(--primary-color);
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            background: white;
            color: var(--primary-dark);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-buttons .btn {
                display: block;
                margin: 10px 0;
            }

            .hero-image {
                margin-top: 2rem;
                max-height: 300px !important;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ronik\OneDrive\Desktop\Laravel-main\resources\views/welcome.blade.php ENDPATH**/ ?>