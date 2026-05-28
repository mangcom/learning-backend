<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 6: RESTful API Design Best Practices & Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* สไตล์เพิ่มเติมเฉพาะหน่วยที่ 6 */
        .api-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .api-table th,
        .api-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            text-align: left;
            font-size: 0.95rem;
        }

        .api-table th {
            background-color: #0f172a;
            color: #fff;
            font-weight: 600;
        }

        .api-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
            color: #fff;
            width: 50px;
            text-align: center;
        }

        .status-2xx {
            background-color: #10b981;
        }

        /* เขียว */
        .status-3xx {
            background-color: #3b82f6;
        }

        /* น้ำเงิน */
        .status-4xx {
            background-color: #f59e0b;
        }

        /* ส้ม */
        .status-5xx {
            background-color: #ef4444;
        }

        /* แดง */

        .method-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            color: #fff;
            min-width: 65px;
            text-align: center;
        }

        .method-get {
            background-color: #10b981;
        }

        .method-post {
            background-color: #3b82f6;
        }

        .method-put {
            background-color: #f59e0b;
        }

        .method-delete {
            background-color: #ef4444;
        }

        .swagger-box {
            background-color: #f0fdf4;
            border-left: 4px solid #85ea2d;
            /* สีเขียวของ Swagger */
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .step-badge {
            background: #2563eb;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-right: 5px;
        }

        .good-practice {
            color: #16a34a;
            font-weight: bold;
        }

        .bad-practice {
            color: #dc2626;
            font-weight: bold;
            text-decoration: line-through;
        }
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>
    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">
                <span class="arrow-icon">⬅</span>
                <span>กลับสู่หน้าหลักวิชา</span>
            </a>
            <h2>หน่วยที่ 6: RESTful API Design Best Practices & Documentation</h2>
            <p>สัปดาห์ที่ 8-9 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        <strong>REST (Representational State Transfer)</strong> เป็นสถาปัตยกรรมซอฟต์แวร์มาตรฐานที่ได้รับความนิยมสูงสุดในการสื่อสารระหว่างระบบบนอินเทอร์เน็ต การออกแบบ Endpoint ที่ดีต้องเข้าใจง่าย เป็นระบบ และสื่อความหมายผ่าน <strong>HTTP Methods</strong> ร่วมกับการใช้ <strong>HTTP Status Codes</strong> แจ้งผลลัพธ์อย่างถูกต้อง นอกจากนี้ การทดสอบระบบด้วย <strong>Postman</strong> และการจัดทำคู่มือ API ให้นักพัฒนาฝั่ง Front-end อ่านผ่าน <strong>Swagger (OpenAPI)</strong> ถือเป็นทักษะบังคับที่โปรแกรมเมอร์ฝั่ง Back-end ทุกคนต้องเชี่ยวชาญ
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>🏛️ 1. กฎทองของการออกแบบ RESTful API Endpoints (Best Practices)</h3>
                <p>ในการสร้าง URL (Endpoint) เพื่อให้บริการข้อมูล เราไม่ควรตั้งชื่อตามใจชอบ แต่ควรยึดหลักการที่นักพัฒนาทั่วโลกเข้าใจตรงกัน เพื่อให้ API ของเราใช้งานง่ายและดูแลรักษาง่าย (Maintainable)</p>

                <br>
                <h4>1.1 ใช้คำนาม (Nouns) ไม่ใช้คำกริยา (Verbs)</h4>
                <p>Endpoint ควรเป็นตัวแทนของทรัพยากร (Resource) หน้าที่ในการบ่งบอก "การกระทำ" จะเป็นของ HTTP Methods (GET, POST, PUT, DELETE) แทน</p>
                <ul style="margin-left: 25px; line-height: 1.8;">
                    <li><span class="bad-practice">❌ ไม่ดี:</span> <code class="inline-code">/getUsers</code>, <code class="inline-code">/createProduct</code>, <code class="inline-code">/deleteOrder/5</code></li>
                    <li><span class="good-practice">✅ ดี:</span> <code class="inline-code">GET /users</code>, <code class="inline-code">POST /products</code>, <code class="inline-code">DELETE /orders/5</code></li>
                </ul>

                <br>
                <h4>1.2 ใช้คำนามรูปพหูพจน์ (Plural Nouns) เสมอ</h4>
                <p>เพื่อความเป็นระเบียบและครอบคลุมทั้งการดึงข้อมูลทั้งหมดและการดึงเฉพาะรายบุคคล ควรใช้รูปพหูพจน์ทั้งหมด</p>
                <ul style="margin-left: 25px; line-height: 1.8;">
                    <li><span class="bad-practice">❌ ไม่ดี:</span> <code class="inline-code">/student/1001</code>, <code class="inline-code">/category/5</code></li>
                    <li><span class="good-practice">✅ ดี:</span> <code class="inline-code">/students/1001</code>, <code class="inline-code">/categories/5</code></li>
                </ul>

                <br>
                <h4>1.3 การจัดการความสัมพันธ์เชิงซ้อน (Nesting Resources)</h4>
                <p>หากทรัพยากรมีความเกี่ยวข้องกัน สามารถออกแบบให้ Endpoint ซ้อนกันได้ แต่อย่าให้ซ้อนลึกเกิน 2-3 ระดับ</p>
                <ul style="margin-left: 25px; line-height: 1.8;">
                    <li><span class="good-practice">✅ สมเหตุสมผล:</span> <code class="inline-code">GET /users/123/orders</code> (ดึงรายการสั่งซื้อทั้งหมดของรหัสผู้ใช้ 123)</li>
                    <li><span class="bad-practice">❌ ลึกเกินไป:</span> <code class="inline-code">GET /users/123/orders/456/items/789</code> (ควรรวบยอดเป็น <code class="inline-code">GET /items/789</code> แทน)</li>
                </ul>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🚦 2. การควบคุมและแจ้งผลด้วย HTTP Status Codes</h3>
                <p>เมื่อเซิร์ฟเวอร์ประมวลผลเสร็จ การส่งแค่ข้อความว่า "สำเร็จ" หรือ "ไม่สำเร็จ" นั้นไม่เพียงพอ มาตรฐาน REST บังคับให้เราแนบตัวเลขรหัส 3 หลักกลับไปด้วย เพื่อให้ระบบฝั่ง Front-end (หรือแอปพลิเคชัน) ตัดสินใจทำงานต่ออัตโนมัติได้</p>

                <table class="api-table">
                    <thead>
                        <tr>
                            <th width="15%">รหัส (Code)</th>
                            <th width="20%">หมวดหมู่</th>
                            <th>ความหมายและสถานการณ์ที่ควรใช้</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="status-badge status-2xx">200</span></td>
                            <td><strong>OK</strong></td>
                            <td>ประมวลผลสำเร็จ (ใช้คู่กับ GET, PUT)</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-2xx">201</span></td>
                            <td><strong>Created</strong></td>
                            <td>สร้างทรัพยากรใหม่ในฐานข้อมูลสำเร็จแล้ว (ใช้คู่กับ POST)</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-2xx">204</span></td>
                            <td><strong>No Content</strong></td>
                            <td>ทำงานสำเร็จ แต่ไม่มีเนื้อหาอะไรจะส่งกลับ (มักใช้คู่กับ DELETE)</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-4xx">400</span></td>
                            <td><strong>Bad Request</strong></td>
                            <td>ไคลเอนต์ส่งข้อมูลมาผิดรูปแบบ หรือข้อมูลไม่ครบถ้วน (เซิร์ฟเวอร์ปฏิเสธ)</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-4xx">401</span></td>
                            <td><strong>Unauthorized</strong></td>
                            <td>ยังไม่ได้เข้าสู่ระบบ (ไม่มี Token) หรือยืนยันตัวตนไม่ผ่าน</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-4xx">403</span></td>
                            <td><strong>Forbidden</strong></td>
                            <td>ล็อกอินแล้ว แต่<strong>ไม่มีสิทธิ์</strong>เข้าถึงข้อมูลส่วนนี้ (เช่น เป็น User แต่พยายามลบข้อมูลระบบ)</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-4xx">404</span></td>
                            <td><strong>Not Found</strong></td>
                            <td>ไม่พบ Endpoint นี้ หรือไม่พบข้อมูลรหัสที่ร้องขอในฐานข้อมูล</td>
                        </tr>
                        <tr>
                            <td><span class="status-badge status-5xx">500</span></td>
                            <td><strong>Server Error</strong></td>
                            <td>โค้ดฝั่งเซิร์ฟเวอร์พัง หรือ Database ล่มกะทันหัน (เป็นความผิดของคนทำ Back-end)</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>📖 3. การจัดทำคู่มือ API สากลด้วย Swagger (OpenAPI)</h3>
                <div class="swagger-box">
                    <strong>💡 ทำไมต้องทำคู่มือ API?</strong>
                    <p style="margin-top: 5px; font-size: 0.9rem; color: #334155;">
                        ในการทำงานจริง นักพัฒนา Back-end สร้าง API ไว้รอนักพัฒนา Front-end (Web/Mobile) มาเชื่อมต่อ หากไม่มีคู่มือ (Documentation) ฝั่ง Front-end จะไม่รู้เลยว่าต้องยิงไปที่ URL ไหน, ต้องแนบข้อมูลอะไรไป และจะได้อะไรกลับมา <strong>Swagger UI</strong> คือไลบรารีที่แปลงโค้ดคอมเมนต์ของเราให้กลายเป็นหน้าเว็บไซต์คู่มือสวยงามที่สามารถ "กดทดสอบยิง API ได้จริงบนหน้าเว็บทันที"
                    </p>
                </div>

                <h4>3.1 การติดตั้งและตั้งค่า Swagger ใน Express</h4>
                <p>เราจำเป็นต้องใช้แพ็กเกจ 2 ตัว คือ <code class="inline-code">swagger-ui-express</code> (สร้างหน้าต่าง UI) และ <code class="inline-code">swagger-jsdoc</code> (แปลงคอมเมนต์ในโค้ดให้อ่านได้)</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Setup Swagger)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const swaggerJsDoc = require('swagger-jsdoc');
const swaggerUi = require('swagger-ui-express');

const app = express();
app.use(express.json());

// 1. ตั้งค่าพื้นฐานสำหรับหน้าคู่มือ Swagger
const swaggerOptions = {
    swaggerDefinition: {
        openapi: '3.0.0', // กำหนดมาตรฐาน OpenAPI
        info: {
            title: '🎓 College Management API',
            version: '1.0.0',
            description: 'คู่มือสำหรับเชื่อมต่อระบบบริหารจัดการวิทยาลัย (RESTful API)',
            contact: { name: 'IT Department' }
        },
        servers: [ { url: 'http://localhost:3000' } ]
    },
    apis: ['app.js'], // ระบุไฟล์ที่ Swagger จะเข้าไปกวาดหาคอมเมนต์ (เช่นไฟล์นี้)
};

// 2. สร้างออบเจกต์และสร้าง Route สำหรับเปิดดูคู่มือ
const swaggerDocs = swaggerJsDoc(swaggerOptions);
app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerDocs));</code></pre>
                </div>

                <br>
                <h4>3.2 การเขียน JSDoc Comment เหนือ Endpoint</h4>
                <p>Swagger จะอ่านคอมเมนต์ที่มีรูปแบบพิเศษ (คล้ายภาษา YAML) ที่อยู่ด้านบนของแต่ละ Route เพื่อนำไปวาดหน้า UI:</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Swagger Annotation)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>/**
 * @swagger
 * /api/students:
 * get:
 * summary: ดึงรายชื่อนักศึกษาทั้งหมด
 * tags: [Students]
 * responses:
 * 200:
 * description: สำเร็จ ส่งกลับอาร์เรย์ข้อมูลนักศึกษา
 * 500:
 * description: เซิร์ฟเวอร์ขัดข้อง
 */
app.get('/api/students', (req, res) => {
    res.status(200).json([{ id: 1, name: "สมชาย" }, { id: 2, name: "สมหญิง" }]);
});</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 4. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> สร้างระบบจัดการหนังสือห้องสมุดแบบ RESTful พร้อมเอกสาร Swagger และทดสอบด้วย Postman</p>
                <p><strong>วัตถุประสงค์:</strong> ผสานองค์ความรู้ทั้งหมด ออกแบบ Endpoint, คุม Status Code, วางโครงสร้าง Swagger และทดสอบได้จริง</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> สร้างโปรเจกต์ใหม่ชื่อ <code class="inline-code">library-api-lab</code> เปิด Terminal แล้วพิมพ์คำสั่ง:</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm init -y
npm install express swagger-ui-express swagger-jsdoc</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 2</span> สร้างไฟล์ <code class="inline-code">app.js</code> เขียนโค้ดระบบที่มีครบทั้ง GET และ POST พร้อมคำอธิบาย Swagger:</p>
                </div>

                <div class="code-window" style="margin-top: 15px;">
                    <div class="code-header">
                        <span>javascript (app.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const swaggerJsDoc = require('swagger-jsdoc');
const swaggerUi = require('swagger-ui-express');

const app = express();
app.use(express.json());

// ⚙️ การตั้งค่า Swagger OpenAPI
const swaggerOptions = {
    swaggerDefinition: {
        openapi: '3.0.0',
        info: { title: '📚 Library API', version: '1.0.0', description: 'ระบบจัดการหนังสือห้องสมุด' },
        servers: [{ url: 'http://localhost:3000' }]
    },
    apis: ['app.js'],
};
app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerJsDoc(swaggerOptions)));

// จำลองฐานข้อมูลแบบ Array
let books = [
    { id: 1, title: "Node.js พื้นฐาน", author: "อ.พรชัย" }
];

/**
 * @swagger
 * /api/books:
 * get:
 * summary: ดูรายชื่อหนังสือทั้งหมด
 * tags: [Books]
 * responses:
 * 200:
 * description: สำเร็จ
 */
app.get('/api/books', (req, res) => {
    res.status(200).json({ status: "success", data: books });
});

/**
 * @swagger
 * /api/books:
 * post:
 * summary: เพิ่มหนังสือเล่มใหม่
 * tags: [Books]
 * requestBody:
 * required: true
 * content:
 * application/json:
 * schema:
 * type: object
 * properties:
 * title: { type: string }
 * author: { type: string }
 * responses:
 * 201:
 * description: สร้างหนังสือใหม่สำเร็จ
 * 400:
 * description: ข้อมูลที่ส่งมาไม่ครบถ้วน
 */
app.post('/api/books', (req, res) => {
    const { title, author } = req.body;
    
    // ตรวจสอบข้อมูล ป้องกัน 400 Bad Request
    if (!title || !author) {
        return res.status(400).json({ status: "fail", message: "กรุณาระบุชื่อหนังสือและชื่อผู้แต่ง" });
    }

    const newBook = { id: books.length + 1, title, author };
    books.push(newBook);
    
    // ส่งสถานะ 201 Created
    res.status(201).json({ status: "success", data: newBook });
});

app.listen(3000, () => console.log('🚀 Server started! เปิดดูคู่มือ API ได้ที่ http://localhost:3000/api-docs'));</code></pre>
                </div>

                <div style="margin-top: 15px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> รันแอปพลิเคชันด้วยคำสั่ง <code class="inline-code">node app.js</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> เปิดเบราว์เซอร์ไปที่ลิงก์ <strong><a href="http://localhost:3000/api-docs" target="_blank">http://localhost:3000/api-docs</a></strong> คุณจะพบกับหน้าตา UI สวยงามของ Swagger ให้นักเรียนทดลองกดปุ่ม <strong>Try it out</strong> เพื่อยิง API ดูผลลัพธ์ผ่านเว็บ</p>
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> เปิดโปรแกรม <strong>Postman</strong> ยิงทดสอบ Endpoint เมธอด POST ไปที่ <code class="inline-code">http://localhost:3000/api/books</code> โดยจงใจไม่ส่งข้อมูล <code class="inline-code">title</code> เพื่อทดสอบดูว่าระบบคายสถานะ <code class="inline-code">400 Bad Request</code> ออกมาได้ถูกต้องหรือไม่</p>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 6: การออกแบบสถาปัตยกรรมระบบร้านค้า (E-Commerce REST API) และจัดทำ Swagger UI</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษาสร้าง API สำหรับระบบจัดการสินค้า (<code class="inline-code">/api/products</code>) โดยต้องประกอบไปด้วย 4 Endpoints ครบถ้วนตามมาตรฐาน CRUD ได้แก่:
                        <ul style="margin-left: 20px; list-style-type: circle;">
                            <li><span class="method-badge method-get">GET</span> ดึงสินค้าทั้งหมด (ส่งสเตตัส 200)</li>
                            <li><span class="method-badge method-post">POST</span> เพิ่มสินค้าใหม่ (ส่งสเตตัส 201 หรือ 400 หากข้อมูลผิด)</li>
                            <li><span class="method-badge method-put">PUT</span> <code class="inline-code">/api/products/:id</code> แก้ไขข้อมูล (ส่งสเตตัส 200 หรือ 404 หากไม่พบ ID)</li>
                            <li><span class="method-badge method-delete">DELETE</span> <code class="inline-code">/api/products/:id</code> ลบสินค้า (ส่งสเตตัส 204)</li>
                        </ul>
                    </li>
                    <li>ต้องเขียน JSDoc Comment ระบุข้อมูลให้ <strong>Swagger UI</strong> อ่านและเรนเดอร์คู่มือของทั้ง 4 Endpoints ได้ครบถ้วน</li>
                    <li>ให้ทดสอบทุกเส้นทางผ่าน Postman (จัด Collection) </li>
                    <li>ส่งงานโดยการแคปภาพหน้าจอ <strong>Swagger UI</strong> และแคปหน้าต่างโปรแกรม <strong>Postman (เน้นให้เห็นรหัส Status Code ที่ถูกต้อง)</strong> อัปโหลดส่งในคลาสเรียน</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• การตั้งชื่อ Endpoint และเลือกใช้ HTTP Method ตรงตามหลักสถาปัตยกรรม RESTful (1.5 คะแนน)</li>
                    <li>• การจัดการและส่งคืน HTTP Status Codes (200, 201, 204, 400, 404) ได้ถูกต้องตามสถานการณ์ (1.5 คะแนน)</li>
                    <li>• การเชื่อมต่อและเขียน Document โครงสร้าง Swagger UI แสดงผลได้สมบูรณ์ (1 คะแนน)</li>
                    <li>• หลักฐานการทดสอบด้วย Postman และความรับผิดชอบในการส่งงาน (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>