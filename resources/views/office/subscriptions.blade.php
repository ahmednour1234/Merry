<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاشتراكات - نظام ميري للاستقدام</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f8fafc 100%);
            min-height: 100vh;
            padding: 20px;
            direction: rtl;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(5, 79, 49, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .app-name {
            font-size: 36px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 30px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .current-subscription {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 40px;
        }

        .current-subscription h3 {
            font-size: 22px;
            font-weight: 700;
            color: #054F31;
            margin-bottom: 20px;
        }

        .subscription-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 16px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .info-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .plans-slider-wrapper {
            position: relative;
            margin-bottom: 50px;
            padding: 20px 0;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .swiper {
            width: 100%;
            padding: 20px 0 50px 0;
        }

        .swiper-slide {
            height: auto;
        }

        .swiper-pagination {
            bottom: 0 !important;
        }

        .swiper-pagination-bullet {
            background: #054F31;
            opacity: 0.3;
            width: 12px;
            height: 12px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #054F31;
            width: 30px;
            border-radius: 6px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #054F31;
            background: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #054F31;
            color: white;
            transform: scale(1.1);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
            font-weight: 900;
        }

        .plan-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 24px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 32px 28px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            min-height: 480px;
            height: 100%;
            overflow: hidden;
        }

        .plan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #054F31 0%, #10b981 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .plan-card:hover::before {
            transform: scaleX(1);
        }

        .plan-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 24px 60px rgba(5, 79, 49, 0.25);
            border-color: rgba(5, 79, 49, 0.2);
        }

        .plan-card.current {
            border-color: #054F31;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 50%, #dcfce7 100%);
            box-shadow: 0 15px 40px rgba(5, 79, 49, 0.25);
            animation: pulse-border 2s ease-in-out infinite;
        }

        .plan-card.has-offer {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #ffffff 0%, #fef3c7 50%, #fde68a 100%);
        }

        .plan-card.has-offer:hover {
            border-color: #dc2626;
            box-shadow: 0 24px 60px rgba(220, 38, 38, 0.3);
        }

        .plan-card.current::before {
            transform: scaleX(1);
        }

        @keyframes pulse-border {
            0%, 100% {
                border-color: #054F31;
            }
            50% {
                border-color: #10b981;
            }
        }

        .plan-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #054F31 0%, #10b981 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(5, 79, 49, 0.3);
        }

        .plan-name {
            font-size: 24px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 10px;
            text-align: center;
            line-height: 1.3;
        }

        .plan-description {
            color: #64748b;
            margin-bottom: 24px;
            font-size: 14px;
            text-align: center;
            line-height: 1.5;
            min-height: 42px;
        }

        .plan-price-section {
            text-align: center;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 2px solid #e2e8f0;
            border-bottom: 2px solid #e2e8f0;
        }

        .plan-price {
            font-size: 42px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 6px;
            line-height: 1;
        }

        .plan-currency {
            font-size: 16px;
            color: #64748b;
            font-weight: 600;
        }

        .plan-features {
            list-style: none;
            margin: 0 0 auto 0;
            flex-grow: 1;
            padding: 0;
            max-height: 200px;
            overflow-y: auto;
        }

        .plan-features::-webkit-scrollbar {
            width: 6px;
        }

        .plan-features::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .plan-features::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .plan-features::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .plan-features li {
            padding: 10px 0;
            color: #475569;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: right;
        }

        .plan-features li::before {
            content: '✓';
            color: #10b981;
            font-weight: 900;
            font-size: 20px;
            flex-shrink: 0;
        }

        .plan-card-footer {
            margin-top: auto;
            padding-top: 20px;
        }

        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #054F31 0%, #10b981 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #043a25 0%, #054F31 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(5, 79, 49, 0.3);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #1e293b;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .subscriptions-table {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            overflow-x: auto;
        }

        .subscriptions-table h3 {
            font-size: 22px;
            font-weight: 700;
            color: #054F31;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: right;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            font-weight: 700;
            color: #1e293b;
            font-size: 14px;
        }

        td {
            color: #475569;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-expired {
            background: #fef3c7;
            color: #92400e;
        }

        .status-pending {
            background: #dbeafe;
            color: #1e40af;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #054F31;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        .coupon-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .coupon-input {
            display: flex;
            gap: 10px;
        }

        .coupon-input input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
        }

        .coupon-input input:focus {
            outline: none;
            border-color: #054F31;
            box-shadow: 0 0 0 3px rgba(5, 79, 49, 0.1);
        }

        .welcome-section {
            background: linear-gradient(135deg, #054F31 0%, #10b981 50%, #34d399 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(5, 79, 49, 0.3);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-greeting {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .welcome-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #f0fdf4;
        }

        .welcome-message {
            font-size: 18px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #054F31 0%, #10b981 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(5, 79, 49, 0.15);
            border-color: #054F31;
        }

        .stat-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
        }

        .features-section {
            background: white;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .features-section h3 {
            font-size: 28px;
            font-weight: 800;
            color: #054F31;
            margin-bottom: 30px;
            text-align: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: #f0fdf4;
            transform: translateX(-4px);
        }

        .feature-icon {
            font-size: 28px;
            color: #10b981;
            flex-shrink: 0;
        }

        .feature-content h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .feature-content p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        .faq-section {
            background: white;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .faq-section h3 {
            font-size: 28px;
            font-weight: 800;
            color: #054F31;
            margin-bottom: 30px;
            text-align: center;
        }

        .faq-item {
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: #054F31;
            box-shadow: 0 4px 12px rgba(5, 79, 49, 0.1);
        }

        .faq-question {
            padding: 20px;
            background: #f8fafc;
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: #f0fdf4;
        }

        .faq-question::after {
            content: '+';
            font-size: 24px;
            color: #054F31;
            font-weight: 900;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question::after {
            transform: rotate(45deg);
        }

        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
        }

        .faq-item.active .faq-answer {
            padding: 20px;
            max-height: 500px;
        }

        .floating-buttons {
            position: fixed;
            bottom: 30px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .floating-buttons.left {
            left: 30px;
        }

        .floating-buttons.right {
            right: 30px;
        }

        .floating-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            font-size: 24px;
        }

        .floating-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .floating-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .floating-btn:hover {
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 12px 32px rgba(0,0,0,0.3);
        }

        .floating-btn:active {
            transform: translateY(-2px) scale(1.05);
        }

        .floating-btn-email {
            background: linear-gradient(135deg, #ea4335 0%, #c5221f 100%);
            color: white;
        }

        .floating-btn-whatsapp {
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            color: white;
        }

        .floating-btn-tooltip {
            position: absolute;
            background: #1e293b;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .floating-btn-email .floating-btn-tooltip {
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
        }

        .floating-btn-email .floating-btn-tooltip::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-right-color: #1e293b;
        }

        .floating-btn-whatsapp .floating-btn-tooltip {
            left: 70px;
            top: 50%;
            transform: translateY(-50%);
        }

        .floating-btn-whatsapp .floating-btn-tooltip::after {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: #1e293b;
        }

        .floating-btn:hover .floating-btn-tooltip {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }

        @media (max-width: 768px) {
            .floating-buttons {
                bottom: 20px;
            }

            .floating-buttons.left {
                left: 15px;
            }

            .floating-buttons.right {
                right: 15px;
            }

            .floating-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .floating-btn-tooltip {
                display: none;
            }
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .modal-header h3 {
            font-size: 28px;
            font-weight: 800;
            color: #054F31;
            margin-bottom: 10px;
        }

        .modal-header p {
            color: #64748b;
            font-size: 16px;
        }

        .modal-body {
            margin-bottom: 30px;
        }

        .modal-plan-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .modal-plan-info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-plan-info-item:last-child {
            border-bottom: none;
        }

        .modal-plan-info-label {
            color: #64748b;
            font-weight: 600;
        }

        .modal-plan-info-value {
            color: #1e293b;
            font-weight: 700;
        }

        .modal-plan-info-value.price {
            font-size: 24px;
            color: #054F31;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .modal-actions .btn {
            flex: 1;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 400px;
            width: 90%;
        }

        .toast {
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
            border-right: 4px solid;
        }

        .toast.success {
            border-color: #10b981;
        }

        .toast.warning {
            border-color: #f59e0b;
        }

        .toast.error {
            border-color: #ef4444;
        }

        .toast-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .toast-message {
            flex: 1;
            font-weight: 600;
            color: #1e293b;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .plans-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .offers-section {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fcd34d 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(251, 191, 36, 0.3);
            position: relative;
            overflow: hidden;
        }

        .offers-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            animation: rotate 15s linear infinite;
        }

        .offers-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .offers-title {
            font-size: 36px;
            font-weight: 900;
            color: #92400e;
            margin-bottom: 12px;
            text-shadow: 0 2px 10px rgba(146, 64, 14, 0.2);
        }

        .offers-subtitle {
            font-size: 18px;
            color: #78350f;
            font-weight: 600;
        }

        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .offer-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(146, 64, 14, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 3px solid transparent;
            overflow: hidden;
        }

        .offer-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 50%, #fcd34d 100%);
        }

        .offer-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(146, 64, 14, 0.3);
            border-color: #f59e0b;
        }

        .offer-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 900;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .offer-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 16px;
        }

        .offer-name {
            font-size: 24px;
            font-weight: 900;
            color: #92400e;
            margin-bottom: 12px;
            text-align: center;
        }

        .offer-description {
            color: #78350f;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }

        .offer-discount {
            text-align: center;
            padding: 16px;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .offer-discount-value {
            font-size: 42px;
            font-weight: 900;
            color: #dc2626;
            line-height: 1;
            margin-bottom: 4px;
        }

        .offer-discount-label {
            font-size: 14px;
            color: #78350f;
            font-weight: 700;
        }

        .plan-offer-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
            padding: 10px 18px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 900;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            z-index: 10;
            animation: bounce 2s ease-in-out infinite;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .plan-offer-badge::before {
            content: '🎉';
            font-size: 16px;
        }

        .plan-price-old {
            font-size: 24px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .plan-price-new {
            font-size: 48px;
            font-weight: 900;
            color: #dc2626;
            margin-bottom: 6px;
            line-height: 1;
        }

        .plan-savings {
            font-size: 14px;
            color: #10b981;
            font-weight: 700;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .plans-grid {
                grid-template-columns: 1fr;
            }

            .subscription-info {
                grid-template-columns: 1fr;
            }

            .plan-card {
                min-height: auto;
            }

            .swiper-button-next,
            .swiper-button-prev {
                display: none;
            }

            .offers-grid {
                grid-template-columns: 1fr;
            }

            .offers-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <div class="welcome-content">
                <div class="welcome-greeting">مرحباً بك 👋</div>
                <div class="welcome-name">{{ Auth::guard('office-panel')->user()->name ?? 'مكتب الاستقدام' }}</div>
                <div class="welcome-message">نحن هنا لمساعدتك في إدارة اشتراكاتك والحصول على أفضل الخدمات</div>
            </div>
        </div>

        <div class="header">
            <h1 class="app-name">نظام ميري للاستقدام</h1>
            <h2 class="page-title">الاشتراكات</h2>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-value">{{ $plans->count() }}</div>
                <div class="stat-label">خطط متاحة</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value">{{ $currentSubscription ? '1' : '0' }}</div>
                <div class="stat-label">اشتراك نشط</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-value">{{ $subscriptions->total() }}</div>
                <div class="stat-label">إجمالي الاشتراكات</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💎</div>
                <div class="stat-value">{{ $currentSubscription ? number_format($currentSubscription->price, 0) : '0' }}</div>
                <div class="stat-label">قيمة الاشتراك الحالي</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($currentSubscription)
            <div class="current-subscription">
                <h3>الاشتراك الحالي</h3>
                <div class="subscription-info">
                    <div class="info-item">
                        <div class="info-label">الخطة</div>
                        <div class="info-value">{{ $currentSubscription->plan->translations->where('lang_code', 'ar')->first()?->name ?? $currentSubscription->plan->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">تاريخ الانتهاء</div>
                        <div class="info-value">{{ $currentSubscription->ends_at->format('Y-m-d') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">السعر</div>
                        <div class="info-value">{{ number_format($currentSubscription->price, 2) }} {{ $currentSubscription->currency_code }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">الحالة</div>
                        <div class="info-value">
                            <span class="status-badge status-{{ $currentSubscription->status }}">{{ $currentSubscription->status === 'active' ? 'نشط' : ($currentSubscription->status === 'cancelled' ? 'ملغي' : ($currentSubscription->status === 'pending' ? 'قيد المراجعة' : 'منتهي')) }}</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('office.subscriptions.toggle-auto-renew', $currentSubscription->id) }}" method="POST" style="display: inline-block; margin-left: 10px;">
                    @csrf
                    <label class="toggle-switch">
                        <input type="checkbox" {{ $currentSubscription->auto_renew ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="slider"></span>
                    </label>
                    <span style="margin-right: 10px; font-weight: 600;">التجديد التلقائي</span>
                </form>
                <form action="{{ route('office.subscriptions.cancel', $currentSubscription->id) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من إلغاء الاشتراك؟')">إلغاء الاشتراك</button>
                </form>
            </div>
        @endif

        @php
            $activePromotions = \App\Models\Promotion::on('system')
                ->where('active', true)
                ->where('auto_apply', true)
                ->where(function($q) {
                    $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                })
                ->where(function($q) {
                    $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
                })
                ->orderByDesc('created_at')
                ->get();
        @endphp

        @if($activePromotions->count() > 0)
            <div class="offers-section">
                <div class="offers-header">
                    <h2 class="offers-title">🔥 عروض حصرية 🔥</h2>
                    <p class="offers-subtitle">استفد من أفضل العروض والخصومات المتاحة الآن</p>
                </div>
                <div class="offers-grid">
                    @foreach($activePromotions as $promo)
                        @php
                            $discountText = $promo->type === 'percent'
                                ? $promo->amount . '%'
                                : number_format($promo->amount, 2) . ' ' . ($promo->currency_code ?? 'USD');
                            $planName = $promo->plan_code
                                ? (\App\Models\Plan::on('system')->where('code', $promo->plan_code)->first()?->translations->where('lang_code', 'ar')->first()?->name ?? $promo->plan_code)
                                : 'جميع الخطط';
                        @endphp
                        <div class="offer-card">
                            <span class="offer-badge">عرض محدود</span>
                            <div class="offer-icon">🎁</div>
                            <h3 class="offer-name">{{ $promo->name ?? 'عرض خاص' }}</h3>
                            <p class="offer-description">
                                {{ $promo->plan_code ? "خصم حصري على خطة {$planName}" : 'خصم على جميع الخطط المتاحة' }}
                            </p>
                            <div class="offer-discount">
                                <div class="offer-discount-value">{{ $discountText }}</div>
                                <div class="offer-discount-label">خصم</div>
                            </div>
                            @if($promo->ends_at)
                                <div style="text-align: center; color: #78350f; font-size: 13px; font-weight: 600;">
                                    ينتهي في: {{ \Carbon\Carbon::parse($promo->ends_at)->format('Y-m-d') }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="plans-slider-wrapper">
            <div class="swiper plans-slider">
                <div class="swiper-wrapper">
                    @foreach($plans->getCollection() as $plan)
                        @php
                            $priced = app(\App\Services\SubscriptionService::class)->priced($plan->code);
                            $planName = $plan->translations->where('lang_code', 'ar')->first()?->name ?? $plan->name;
                            $planDesc = $plan->translations->where('lang_code', 'ar')->first()?->description ?? $plan->description;
                            $isCurrent = $currentSubscription && $currentSubscription->plan_code === $plan->code;

                            $hasOffer = false;
                            $originalPrice = $plan->base_price;
                            $finalPrice = $priced['price'] ?? $plan->base_price;
                            $discountPercent = 0;

                            if ($finalPrice < $originalPrice) {
                                $hasOffer = true;
                                $discountPercent = round((($originalPrice - $finalPrice) / $originalPrice) * 100);
                            }
                        @endphp
                        <div class="swiper-slide">
                            <div class="plan-card {{ $isCurrent ? 'current' : '' }} {{ $hasOffer ? 'has-offer' : '' }}">
                                @if($isCurrent)
                                    <span class="plan-badge">الحالية</span>
                                @endif
                                @if($hasOffer)
                                    <span class="plan-offer-badge">خصم {{ $discountPercent }}%</span>
                                @endif
                                <h3 class="plan-name">{{ $planName }}</h3>
                                <p class="plan-description">{{ $planDesc }}</p>
                                <div class="plan-price-section">
                                    @if($hasOffer)
                                        <div class="plan-price-old">{{ number_format($originalPrice, 2) }} {{ $plan->base_currency }}</div>
                                        <div class="plan-price-new">{{ number_format($finalPrice, 2) }}</div>
                                        <div class="plan-currency">{{ $priced['currency'] ?? $plan->base_currency }} / {{ $plan->billing_cycle === 'monthly' ? 'شهري' : 'سنوي' }}</div>
                                        <div class="plan-savings">وفر {{ number_format($originalPrice - $finalPrice, 2) }} {{ $plan->base_currency }}</div>
                                    @else
                                        <div class="plan-price">{{ number_format($finalPrice, 2) }}</div>
                                        <div class="plan-currency">{{ $priced['currency'] ?? $plan->base_currency }} / {{ $plan->billing_cycle === 'monthly' ? 'شهري' : 'سنوي' }}</div>
                                    @endif
                                </div>
                                <ul class="plan-features">
                                    @foreach($plan->features->where('active', true) as $feature)
                                        @php
                                            $translations = [
                                                'cv.limit' => 'عدد CV المسموح',
                                                'request.limit' => 'عدد الطلبات المسموح',
                                                'orders.limit' => 'عدد الطلبات المسموح',
                                                'office.users.limit' => 'عدد المستخدمين المسموح',
                                                'media.storage.gb' => 'مساحة التخزين (GB)',
                                                'support.priority' => 'دعم ذو أولوية',
                                                'cv.freeze.allowed' => 'تجميد CV مسموح',
                                                'exports.per_month' => 'عدد مرات التصدير شهرياً',
                                                'office.multi_branch' => 'دعم تعدد الفروع',
                                                'upload.allowed' => 'الرفع المسموح',
                                            ];
                                            $featureName = $translations[$feature->feature_key] ?? $feature->feature_key;
                                            $featureValue = $feature->limit ?? ($feature->value === 1 ? 'نعم' : ($feature->value ?? '-'));
                                        @endphp
                                        <li>{{ $featureName }}: {{ $featureValue }}</li>
                                    @endforeach
                                </ul>
                                <div class="plan-card-footer">
                                    @if(!$isCurrent)
                                        <button type="button" class="btn btn-primary subscribe-btn"
                                                data-plan-code="{{ $plan->code }}"
                                                data-plan-name="{{ $planName }}"
                                                data-plan-price="{{ number_format($priced['price'] ?? $plan->base_price, 2) }}"
                                                data-plan-currency="{{ $priced['currency'] ?? $plan->base_currency }}"
                                                data-plan-cycle="{{ $plan->billing_cycle === 'monthly' ? 'شهري' : 'سنوي' }}">
                                            اشترك الآن
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" disabled>مشترك حالياً</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>



        <div class="features-section">
            <h3>مميزات نظام ميري</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🚀</div>
                    <div class="feature-content">
                        <h4>أداء عالي</h4>
                        <p>نظام سريع وموثوق لإدارة عمليات الاستقدام بكفاءة عالية</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🔒</div>
                    <div class="feature-content">
                        <h4>أمان متقدم</h4>
                        <p>حماية كاملة لبياناتك مع تشفير متقدم ومعايير أمان عالية</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">📱</div>
                    <div class="feature-content">
                        <h4>متوافق مع جميع الأجهزة</h4>
                        <p>يعمل بسلاسة على الكمبيوتر والهاتف والتابلت</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💬</div>
                    <div class="feature-content">
                        <h4>دعم فني 24/7</h4>
                        <p>فريق دعم متاح على مدار الساعة لمساعدتك في أي وقت</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">📊</div>
                    <div class="feature-content">
                        <h4>تقارير شاملة</h4>
                        <p>إحصائيات وتقارير مفصلة لمتابعة أداء مكتبك</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">⚡</div>
                    <div class="feature-content">
                        <h4>تحديثات مستمرة</h4>
                        <p>نضيف ميزات جديدة باستمرار لتحسين تجربتك</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-section">
            <h3>أسئلة شائعة</h3>
            <div class="faq-item">
                <div class="faq-question">كيف يمكنني تغيير خطتي الحالية؟</div>
                <div class="faq-answer">يمكنك الاشتراك في أي خطة متاحة من خلال الضغط على زر "اشترك الآن" في البطاقة الخاصة بالخطة المطلوبة. سيتم تفعيل الخطة الجديدة فوراً.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">ماذا يحدث عند انتهاء الاشتراك؟</div>
                <div class="faq-answer">عند انتهاء الاشتراك، سيتم إيقاف الخدمات تلقائياً. يمكنك تجديد الاشتراك في أي وقت للحفاظ على استمرارية الخدمة.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">هل يمكنني إلغاء الاشتراك في أي وقت؟</div>
                <div class="faq-answer">نعم، يمكنك إلغاء الاشتراك في أي وقت من خلال قسم "الاشتراك الحالي". لن يتم خصم أي مبالغ إضافية بعد الإلغاء.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">ما هو التجديد التلقائي؟</div>
                <div class="faq-answer">التجديد التلقائي يضمن استمرار اشتراكك دون الحاجة لتجديده يدوياً. يمكنك تفعيله أو إلغاؤه في أي وقت.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">كيف يمكنني التواصل مع الدعم الفني؟</div>
                <div class="faq-answer">يمكنك التواصل مع فريق الدعم الفني على مدار 24 ساعة من خلال البريد الإلكتروني أو الهاتف. نحن هنا لمساعدتك دائماً.</div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="subscribeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تأكيد الاشتراك</h3>
                <p>يرجى مراجعة تفاصيل الاشتراك قبل التأكيد</p>
            </div>
            <div class="modal-body">
                <div class="modal-plan-info">
                    <div class="modal-plan-info-item">
                        <span class="modal-plan-info-label">الخطة:</span>
                        <span class="modal-plan-info-value" id="modalPlanName">-</span>
                    </div>
                    <div class="modal-plan-info-item">
                        <span class="modal-plan-info-label">المدة:</span>
                        <span class="modal-plan-info-value" id="modalPlanCycle">-</span>
                    </div>
                    <div class="modal-plan-info-item">
                        <span class="modal-plan-info-label">السعر:</span>
                        <span class="modal-plan-info-value price" id="modalPlanPrice">-</span>
                    </div>
                </div>
                <div style="background: #fef3c7; border: 1px solid #f59e0b; border-radius: 12px; padding: 16px; margin-top: 20px;">
                    <p style="color: #92400e; font-size: 14px; margin: 0; line-height: 1.6;">
                        <strong>ملاحظة:</strong> بعد تأكيد الاشتراك، سيتم مراجعة طلبك من قبل فريق الدعم. سيتم تفعيل الاشتراك بعد الموافقة.
                    </p>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">إلغاء</button>
                <form id="subscribeForm" method="POST" action="{{ route('office.subscriptions.subscribe') }}">
                    @csrf
                    <input type="hidden" name="plan_code" id="formPlanCode">
                    <button type="submit" class="btn btn-primary">تأكيد والدفع</button>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <div class="floating-buttons left">
        <a href="mailto:support@mery.com" class="floating-btn floating-btn-email" aria-label="البريد الإلكتروني">
            <span>✉️</span>
            <span class="floating-btn-tooltip">راسلنا عبر البريد</span>
        </a>
    </div>

    <div class="floating-buttons right">
        <a href="https://wa.me/966500000000" target="_blank" class="floating-btn floating-btn-whatsapp" aria-label="واتساب">
            <span>💬</span>
            <span class="floating-btn-tooltip">تواصل معنا عبر واتساب</span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.plans-slider', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: false,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                },
            });

            // FAQ Accordion
            document.querySelectorAll('.faq-question').forEach(question => {
                question.addEventListener('click', function() {
                    const faqItem = this.parentElement;
                    const isActive = faqItem.classList.contains('active');

                    // Close all FAQ items
                    document.querySelectorAll('.faq-item').forEach(item => {
                        item.classList.remove('active');
                    });

                    // Open clicked item if it wasn't active
                    if (!isActive) {
                        faqItem.classList.add('active');
                    }
                });
            });

            // Subscribe button click
            document.querySelectorAll('.subscribe-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const planCode = this.dataset.planCode;
                    const planName = this.dataset.planName;
                    const planPrice = this.dataset.planPrice;
                    const planCurrency = this.dataset.planCurrency;
                    const planCycle = this.dataset.planCycle;

                    document.getElementById('modalPlanName').textContent = planName;
                    document.getElementById('modalPlanCycle').textContent = planCycle;
                    document.getElementById('modalPlanPrice').textContent = planPrice + ' ' + planCurrency;
                    document.getElementById('formPlanCode').value = planCode;

                    document.getElementById('subscribeModal').classList.add('active');
                });
            });

            // Close modal on overlay click
            document.getElementById('subscribeModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Handle form submission
            document.getElementById('subscribeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    closeModal();

                    if (data.status === 'pending') {
                        showToast('warning', 'جاري المراجعة من الدعم', 'سيتم مراجعة طلبك والموافقة عليه من قبل فريق الدعم الفني');
                    } else {
                        showToast('success', 'تم الاشتراك بنجاح', 'تم تفعيل الاشتراك بنجاح');
                    }

                    setTimeout(() => {
                        window.location.href = '{{ \Filament\Facades\Filament::getPanel("office")->getUrl() }}';
                    }, 2000);
                })
                .catch(error => {
                    closeModal();
                    showToast('error', 'حدث خطأ', 'حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى.');
                });
            });
        });

        function closeModal() {
            document.getElementById('subscribeModal').classList.remove('active');
        }

        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const icons = {
                success: '✅',
                warning: '⚠️',
                error: '❌'
            };

            toast.innerHTML = `
                <span class="toast-icon">${icons[type] || 'ℹ️'}</span>
                <div class="toast-message">
                    <strong>${title}</strong><br>
                    <span style="font-size: 13px; color: #64748b; font-weight: normal;">${message}</span>
                </div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideDown 0.3s ease reverse';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 5000);
        }
    </script>
</body>
</html>
