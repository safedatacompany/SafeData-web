<template>
    <div class="relative container 2xl:max-w-[100rem] mx-auto z-20 py-36">
        <div class="relative w-full flex flex-col items-center justify-center gap-10 text-white px-7">
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl">PRODUCTS
            </h1>
            <div class="relative w-full grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-7">
                <ProductCard v-motion-slide-visible-bottom :duration="300" v-for="product in products" :key="product.id"
                    :product="product" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ProductCard from '../components/ProductCard.vue';

const products = ref([
    {
        id: 1,
        title: 'Safe ERP',
        description: `World Class ERP Software On SaaS We provide Best and world class ERP SaaS on affordable prices along with a good support and assistance Let's make the ERP Simple Let's make systemize and reduce manual mistakes and make it profitable with help of software support. A Better ERP Software will make your business succeed Powerful ERP Software Can help you to reduce manual works and provide reports to plan for the future.`,
        link: 'https://safeerp.net',
    },
    {
        id: 2,
        title: 'Safe Restaurant',
        description: `Restaurant Database System tailored to streamline restaurant operations. This system could include features like: Menu Management: Easily update and manage menu items, categories, and pricing. Order Management: Track and process customer orders efficiently. Inventory Management: Monitor stock levels, manage suppliers, and track usage. Customer Management: Keep track of customer preferences, reservations, and feedback. Billing and Payment Integration: Simplify billing processes and integrate various payment methods. Reporting and Analytics: Generate reports on sales, inventory, and customer trends. This system would help improve efficiency, reduce errors, and enhance the overall customer experience.`,
        link: '',
    },
    {
        id: 3,
        title: 'Safe Store',
        description: `Safe Store is designed to manage various aspects of wholesale and retail operations efficiently. Key features includes: Product Management: Track and manage product details, pricing, and inventory levels. Sales and Transactions: Process sales, handle returns, and manage transactions. Customer Management: Maintain customer profiles, track purchase history, and manage loyalty programs. Supplier Management: Manage supplier information, purchase orders, and stock replenishment. Reporting and Analytics: Generate sales reports, track inventory trends, and analyze customer behavior. Multi-Store Integration: Manage multiple store locations from a single system. This system helps streamline store operations, improve inventory accuracy, and enhance customer service.`,
        link: '',
    },
    {
        id: 4,
        title: 'Safe Clinic',
        description: `Safe Clinic/Center is designed to streamline clinic operations and improve patient management. Key features includes: Patient Records: Maintain detailed patient profiles, including medical history, treatment plans, and visit records. Appointment Scheduling: Manage and schedule patient appointments, including reminders and cancellations. Billing and Payments: Process patient billing, handle insurance claims, and manage payment records. Recipe: Track and manage recipes. Services: Track and manage clinic’s services. Staff Management: Maintain records of clinic staff, including schedules, roles, and credentials. Reporting and Analytics: Generate reports on patient visits, treatment outcomes, and financial performance. This system helps improve patient care, streamline administrative tasks, and enhance overall clinic efficiency.`,
        link: '',
    },
    {
        id: 5,
        title: 'Safe HR',
        description: `Safe HR is designed to manage and streamline HR functions efficiently. Key features includes: Employee Records: Maintain detailed profiles for employees, including personal information, employment history, and performance reviews. Payroll Management: Automate payroll calculations, tax deductions, and manage salary payments. Leave and Attendance: Track employee attendance, manage leave requests, and generate attendance reports. Recruitment: Manage job postings, track applicants, and streamline the hiring process. Compliance and Reporting: Ensure compliance with labor laws and generate HR-related reports. This system helps improve HR efficiency, ensure accurate record-keeping, and support better employee management.`,
        link: '',
    },
    {
        id: 6,
        title: 'Safe Educational Compound',
        description: `Our dedicated educational community software is designed to streamline and modernize the administrative and accounting tasks for schools, kindergartens, and other educational institutions. The system offers robust user management, featuring role-based access control, and user registration with detailed profile management. It facilitates comprehensive student management, covering registration, admission, attendance, and leave tracking, along with maintaining detailed student profiles, class records, and medical histories. The software also supports organizing events, field trips, and summer courses, providing access to child progress reports through a dedicated portal, and generating extensive reports for all departments. Staff management includes detailed profiles for teachers and staff, attendance and leave management, automated payroll processing, and event organization. Financial management capabilities encompass tuition fee management, various payment methods, installment plans, and detailed financial tracking and reporting. Inventory management allows for efficient tracking of supplies and resource management. Built as a secure web application using the latest technology, our software ensures data protection, continuous backup, and recovery plans. The intuitive interface is accessible on any device and offers both dark and light modes, making it easy and pleasant to use.`,
        link: '',
    },
]);


</script>