<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 7: Database Integration (SQL & NoSQL)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .db-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .db-table th,
        .db-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            text-align: left;
            font-size: 0.95rem;
        }

        .db-table th {
            background-color: #0f172a;
            color: #fff;
            font-weight: 600;
        }

        .db-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .method-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            color: #fff;
            min-width: 70px;
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

        .db-badge-sql {
            background-color: #0284c7;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .db-badge-nosql {
            background-color: #16a34a;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
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
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">⬅ กลับสู่หน้าหลักวิชา</a>
            <h2>หน่วยที่ 7: Database Integration (SQL & NoSQL)</h2>
            <p>สัปดาห์ที่ 10-11 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        หัวใจของระบบ Back-End คือการจัดเก็บและเรียกใช้ข้อมูลอย่างมีประสิทธิภาพ การพัฒนา API ที่ดีจะต้องสามารถสื่อสารกับ <strong>Database (ฐานข้อมูล)</strong> เพื่อทำคำสั่ง <strong>CRUD</strong> (Create, Read, Update, Delete) ได้ ในยุคปัจจุบัน นักพัฒนาจำเป็นต้องเข้าใจการทำงานของทั้งฐานข้อมูลแบบมีโครงสร้างความสัมพันธ์ <strong>(SQL เช่น MySQL)</strong> และฐานข้อมูลที่เน้นความยืดหยุ่นสูง <strong>(NoSQL เช่น MongoDB)</strong> เพื่อเลือกใช้ให้เหมาะสมกับสถาปัตยกรรมของโปรเจกต์
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>⚖️ 1. เปรียบเทียบความแตกต่างระหว่าง SQL และ NoSQL</h3>
                <p>ก่อนที่เราจะเริ่มเขียนโปรแกรม เราต้องเข้าใจความแตกต่างและจุดเด่นของฐานข้อมูลทั้ง 2 ประเภทเสียก่อน:</p>

                <table class="db-table">
                    <thead>
                        <tr>
                            <th width="15%">คุณสมบัติ</th>
                            <th width="42.5%">SQL (Relational Database)</th>
                            <th width="42.5%">NoSQL (Non-Relational Database)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>ตัวอย่างระบบ</strong></td>
                            <td>MySQL, PostgreSQL, SQL Server, Oracle</td>
                            <td>MongoDB, Firebase (Firestore), Redis, Cassandra</td>
                        </tr>
                        <tr>
                            <td><strong>โครงสร้างข้อมูล</strong></td>
                            <td>เก็บเป็น <strong>ตาราง (Table)</strong> มีแถวและคอลัมน์ชัดเจน ต้องกำหนด Schema ล่วงหน้า (Strict Schema)</td>
                            <td>เก็บเป็น <strong>เอกสาร (Document/JSON)</strong> โครงสร้างยืดหยุ่น แต่ละข้อมูลไม่จำเป็นต้องมีฟิลด์เหมือนกัน (Dynamic Schema)</td>
                        </tr>
                        <tr>
                            <td><strong>ความสัมพันธ์</strong></td>
                            <td>โดดเด่นเรื่องการเชื่อมโยงข้อมูลหลายตารางด้วย JOIN (Primary Key / Foreign Key)</td>
                            <td>มักจะเก็บข้อมูลที่เกี่ยวข้องกันไว้ใน Document เดียวกันเลย (Embedding) ลดการ JOIN</td>
                        </tr>
                        <tr>
                            <td><strong>เหมาะกับงานแบบไหน?</strong></td>
                            <td>ระบบบัญชี, การเงิน, คลังสินค้า ที่โครงสร้างข้อมูลตายตัวและต้องการความถูกต้องสูง (ACID Properties)</td>
                            <td>ระบบ Social Media, E-Commerce Catalog, IoT ที่ข้อมูลมีการเปลี่ยนแปลงโครงสร้างบ่อยและมีปริมาณมหาศาล</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3><span class="db-badge-sql">MySQL</span> 2. การสร้าง RESTful API ควบคู่กับ MySQL</h3>
                <p>ใน Node.js นิยมใช้แพ็กเกจ <code class="inline-code">mysql2</code> ร่วมกับ <strong>Promises</strong> เพื่อให้เขียนโค้ดแบบ <code class="inline-code">async/await</code> ได้ง่ายขึ้น โดยจำลองการจัดการข้อมูล <strong>"พนักงาน (Employees)"</strong></p>

                <div class="code-window" style="margin-bottom: 15px;">
                    <pre><code>npm install express mysql2</code></pre>
                </div>

                <h4>2.1 โค้ดตัวอย่าง: การเชื่อมต่อและการทำ CRUD Operations (MySQL)</h4>
                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (mysql-api.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const mysql = require('mysql2/promise'); // ใช้เวอร์ชัน promise รองรับ async/await
const app = express();
app.use(express.json());

// 1. ตั้งค่าการเชื่อมต่อฐานข้อมูล (Connection Pool)
const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'company_db',
    waitForConnections: true,
    connectionLimit: 10, // จัดการคิวการเชื่อมต่อพร้อมกัน 10 เครื่อง
});

// ==========================================
// 🛠️ สร้างเส้นทาง API (CRUD)
// ==========================================

// 🟢 [READ] ดึงข้อมูลพนักงานทั้งหมด
app.get('/api/employees', async (req, res) => {
    try {
        // ใช้ destructuring ดึงค่า rows ออกมาจากผลลัพธ์
        const [rows] = await pool.query('SELECT * FROM employees');
        res.status(200).json({ status: "success", data: rows });
    } catch (error) {
        res.status(500).json({ status: "error", message: error.message });
    }
});

// 🔵 [CREATE] เพิ่มพนักงานใหม่
app.post('/api/employees', async (req, res) => {
    try {
        const { first_name, last_name, position, salary } = req.body;
        // ป้องกัน SQL Injection โดยใช้ ? (Prepared Statement)
        const sql = 'INSERT INTO employees (first_name, last_name, position, salary) VALUES (?, ?, ?, ?)';
        const [result] = await pool.query(sql, [first_name, last_name, position, salary]);
        
        res.status(201).json({ 
            status: "success", 
            message: "เพิ่มพนักงานสำเร็จ", 
            insertId: result.insertId 
        });
    } catch (error) {
        res.status(500).json({ status: "error", message: error.message });
    }
});

// 🟠 [UPDATE] แก้ไขข้อมูลเงินเดือน
app.put('/api/employees/:id', async (req, res) => {
    try {
        const empId = req.params.id;
        const { salary } = req.body;
        const sql = 'UPDATE employees SET salary = ? WHERE id = ?';
        const [result] = await pool.query(sql, [salary, empId]);
        
        if (result.affectedRows === 0) {
            return res.status(404).json({ status: "fail", message: "ไม่พบข้อมูลพนักงาน" });
        }
        res.status(200).json({ status: "success", message: "อัปเดตข้อมูลสำเร็จ" });
    } catch (error) {
        res.status(500).json({ status: "error", message: error.message });
    }
});

// 🔴 [DELETE] ลบพนักงานออกจากระบบ
app.delete('/api/employees/:id', async (req, res) => {
    try {
        const [result] = await pool.query('DELETE FROM employees WHERE id = ?', [req.params.id]);
        if (result.affectedRows === 0) return res.status(404).json({ message: "ไม่พบข้อมูล" });
        
        res.status(204).send(); // 204 คือสำเร็จแต่ไม่มีข้อมูลส่งกลับ
    } catch (error) {
        res.status(500).json({ status: "error", message: error.message });
    }
});

app.listen(3000, () => console.log('🚀 MySQL API ทำงานที่พอร์ต 3000'));</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3><span class="db-badge-nosql">MongoDB</span> 3. การสร้าง RESTful API ควบคู่กับ MongoDB (ผ่าน Mongoose)</h3>
                <p>การทำงานกับ MongoDB ใน Node.js นิยมใช้ <strong>Mongoose (ODM - Object Data Modeling)</strong> ซึ่งช่วยให้เราสามารถกำหนดโครงสร้างเอกสาร (Schema) และมีคำสั่งสำเร็จรูปให้เรียกใช้จัดการข้อมูลได้ง่ายดายมาก</p>

                <div class="code-window" style="margin-bottom: 15px;">
                    <pre><code>npm install express mongoose</code></pre>
                </div>

                <h4>3.1 โค้ดตัวอย่าง: การเชื่อมต่อ, สร้าง Schema และทำ CRUD Operations (MongoDB)</h4>
                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (mongo-api.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const mongoose = require('mongoose');
const app = express();
app.use(express.json());

// 1. เชื่อมต่อ MongoDB (เปลี่ยน URL เป็นของตัวเองหากใช้ MongoDB Atlas)
mongoose.connect('mongodb://localhost:27017/shop_db')
    .then(() => console.log('🟢 เชื่อมต่อ MongoDB สำเร็จ!'))
    .catch(err => console.error('🔴 เชื่อมต่อฐานข้อมูลล้มเหลว:', err));

// 2. สร้าง Schema และ Model (เปรียบเสมือนการสร้างตาราง)
const productSchema = new mongoose.Schema({
    name: { type: String, required: true }, // บังคับกรอก
    price: { type: Number, min: 0 },       // ต้องมีค่ามากกว่าหรือเท่ากับ 0
    category: { type: String, default: "General" }, // ค่าเริ่มต้น
    inStock: { type: Boolean, default: true }
}, { timestamps: true }); // เปิดระบบบันทึกเวลา createdAt, updatedAt อัตโนมัติ

const Product = mongoose.model('Product', productSchema);

// ==========================================
// 🛠️ สร้างเส้นทาง API (CRUD)
// ==========================================

// 🔵 [CREATE] เพิ่มสินค้าใหม่ (.save หรือ .create)
app.post('/api/products', async (req, res) => {
    try {
        // Mongoose จะเช็กข้อมูลตาม Schema ให้อัตโนมัติ
        const newProduct = new Product(req.body);
        const savedProduct = await newProduct.save();
        res.status(201).json({ status: "success", data: savedProduct });
    } catch (error) {
        res.status(400).json({ status: "fail", message: error.message });
    }
});

// 🟢 [READ] ค้นหาสินค้า (.find และกรองข้อมูล)
app.get('/api/products', async (req, res) => {
    try {
        // ดึงเฉพาะสินค้าที่ราคามากกว่า 100 และมีของในสต็อก
        // const products = await Product.find({ price: { $gt: 100 }, inStock: true });
        
        // ดึงข้อมูลทั้งหมด
        const products = await Product.find(); 
        res.status(200).json({ status: "success", count: products.length, data: products });
    } catch (error) {
        res.status(500).json({ message: "Server Error" });
    }
});

// 🟠 [UPDATE] แก้ไขข้อมูลสินค้า (.findByIdAndUpdate)
app.put('/api/products/:id', async (req, res) => {
    try {
        const updatedProduct = await Product.findByIdAndUpdate(
            req.params.id, 
            req.body, 
            { new: true, runValidators: true } // ส่งข้อมูลใหม่กลับมา & ตรวจเช็ก Schema อีกรอบ
        );
        
        if (!updatedProduct) return res.status(404).json({ message: "ไม่พบรหัสสินค้านี้" });
        res.status(200).json({ status: "success", data: updatedProduct });
    } catch (error) {
        res.status(400).json({ status: "error", message: error.message });
    }
});

// 🔴 [DELETE] ลบสินค้า (.findByIdAndDelete)
app.delete('/api/products/:id', async (req, res) => {
    try {
        const deletedProduct = await Product.findByIdAndDelete(req.params.id);
        if (!deletedProduct) return res.status(404).json({ message: "ไม่พบรหัสสินค้านี้" });
        
        res.status(204).send();
    } catch (error) {
        res.status(500).json({ message: "Server Error" });
    }
});

app.listen(5000, () => console.log('🚀 MongoDB API ทำงานที่พอร์ต 5000'));</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 4. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> พัฒนาระบบ API สำหรับแอปพลิเคชัน "Todo List (บันทึกงานประจำวัน)" ด้วย MongoDB</p>
                <p><strong>วัตถุประสงค์:</strong> ให้นักศึกษาคุ้นชินกับการใช้ Mongoose จัดการฐานข้อมูล NoSQL ตั้งแต่การสร้าง Schema ไปจนถึงการเขียน Route</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> จำลองการตั้งค่าโปรเจกต์ใหม่และติดตั้ง <code class="inline-code">express</code> และ <code class="inline-code">mongoose</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 2</span> สร้างฐานข้อมูลใน MongoDB Compass ชื่อ <code class="inline-code">todo_app</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> สร้างโมเดล Schema ชื่อ <strong>Task</strong> โดยประกอบด้วย 2 ฟิลด์หลักคือ: <code class="inline-code">title (String, บังคับกรอก)</code> และ <code class="inline-code">isCompleted (Boolean, ค่าเริ่มต้นคือ false)</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> สร้าง Endpoint 2 เส้นทางเพื่อทดสอบระบบ:</p>
                    <ul style="margin-left: 35px; list-style-type: square;">
                        <li><span class="method-badge method-post">POST</span> <code class="inline-code">/api/tasks</code> : เพื่อรับค่า title จากผู้ใช้ไปบันทึกลงฐานข้อมูล</li>
                        <li><span class="method-badge method-put">PUT</span> <code class="inline-code">/api/tasks/:id/complete</code> : เมื่อผู้ใช้เรียกเส้นทางนี้ ระบบจะค้นหา Task ตาม ID และอัปเดตฟิลด์ <code class="inline-code">isCompleted</code> ให้เป็น <code class="inline-code">true</code> เสมอ</li>
                    </ul>
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> เปิดโปรแกรม Postman ยิงข้อมูลทดสอบ และตรวจสอบผลลัพธ์ผ่านโปรแกรม MongoDB Compass ว่าข้อมูลถูกบันทึกจริงหรือไม่</p>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 7: ระบบบริหารจัดการคลังสินค้าหรือนักศึกษา (Full CRUD Database API)</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษาเลือกระบบฐานข้อมูลที่ตนเองถนัดที่สุด 1 ระบบ (ระหว่าง <strong>MySQL</strong> หรือ <strong>MongoDB</strong>)</li>
                    <li>สร้างโปรเจกต์ API สำหรับ <strong>"ระบบลงทะเบียนนักศึกษา"</strong> หรือ <strong>"ระบบจัดการสต็อกสินค้า"</strong> โดยให้มีฟิลด์ข้อมูลอย่างน้อย 4 ฟิลด์ (เช่น ชื่อ, นามสกุล, สาขาวิชา, เกรดเฉลี่ย)</li>
                    <li>เขียน Endpoints ให้ครบกระบวนการ <strong>CRUD (GET, POST, PUT, DELETE)</strong> </li>
                    <li>ในเมธอด GET (อ่านข้อมูล) ให้นักศึกษาทดลองเขียนแบบมี <strong>Query String</strong> เช่น <code class="inline-code">?major=IT</code> เพื่อสั่งให้ระบบกรองและดึงข้อมูลเฉพาะสาขาวิชา IT ออกมาจากฐานข้อมูลเท่านั้น</li>
                    <li>ส่งงานโดยการอัดคลิปวิดีโอสั้น (ไม่เกิน 3 นาที) อธิบายโครงสร้างโค้ด และรัน Postman เพื่อพิสูจน์การทำงานทั้ง 4 เมธอดให้เห็นผลลัพธ์ว่าบันทึกลงฐานข้อมูลได้จริง</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 10 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• การออกแบบและเชื่อมต่อฐานข้อมูลได้อย่างถูกต้องไม่มีข้อผิดพลาด (2 คะแนน)</li>
                    <li>• ความสมบูรณ์ของการเขียน Endpoint ครบทั้ง 4 เมธอด CRUD (4 คะแนน)</li>
                    <li>• การประยุกต์ใช้ Query String ร่วมกับการค้นหา (Where/Filter) ในฐานข้อมูล (2 คะแนน)</li>
                    <li>• ความเข้าใจในการอธิบายโค้ด และความครบถ้วนของการทดสอบผ่าน Postman (2 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>