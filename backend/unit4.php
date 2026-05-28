<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 4: Express.js Architecture & Routing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* สไตล์เพิ่มเติมเฉพาะหน้าเพื่อความสมบูรณ์ */
        .routing-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .routing-table th,
        .routing-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            text-align: left;
            font-size: 0.95rem;
        }

        .routing-table th {
            background-color: #0f172a;
            color: #fff;
            font-weight: 600;
        }

        .routing-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .method-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            color: #fff;
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
            <h2>หน่วยที่ 4: Express.js Architecture & Routing</h2>
            <p>สัปดาห์ที่ 4 | เวลาเรียน 5 ชั่วโมง (ทฤษฎี 1 ชม. ปฏิบัติ 4 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญ (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        แม้ว่า Node.js จะสามารถสร้างเว็บเซิร์ฟเวอร์ได้ด้วยโมดูลในตัว แต่การเขียนโค้ดจะมีความซับซ้อนและยาวเกินความจำเป็น นักพัฒนาจึงนิยมใช้ <strong>Express.js</strong> ซึ่งเป็น Minimalist Web Framework ที่เป็นที่นิยมอันดับหนึ่ง เพื่อเข้ามาช่วยจัดการโครงสร้างสถาปัตยกรรมระบบหลังบ้าน รวมถึงระบบการควบคุมเส้นทาง <strong>(Routing)</strong> และการดึงข้อมูลจากเครื่องลูกข่ายผ่าน <strong>URL Parameter</strong> และ <strong>Query String</strong> ได้อย่างมีประสิทธิภาพและเป็นระบบ
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>📑 1. โครงสร้างและสถาปัตยกรรมของ Express.js</h3>
                <p>Express.js ทำหน้าที่เป็นเลเยอร์ที่ครอบ (Wrap) ต่อยอดมาจาก Node.js อีกทีหนึ่ง โดยสถาปัตยกรรมภายในจะเน้นการทำงานตามวงจรของ <strong>Request-Response Cycle</strong> เมื่อเบราว์เซอร์ส่งคำร้องขอ (Request) เข้ามา ตัว Express จะตรวจดูว่าตรงกับเส้นทาง (Route) และเมธอด (HTTP Method) ใด จากนั้นจะประมวลผลและส่งผลลัพธ์ (Response) กลับไปในรูปแบบข้อความ, HTML หรือ JSON เสมอ</p>

                <br>
                <h4>1.1 โครงสร้างไฟล์พื้นฐานของโปรเจกต์ Express.js</h4>
                <p>ในการเริ่มต้นสร้างแอปพลิเคชัน โครงสร้างไฟล์ที่เรียบง่ายที่สุดจะประกอบไปด้วย:</p>
                <div class="code-window" style="background-color: #0f172a; padding: 15px; border-radius: 8px; color: #94a3b8; font-family: monospace;">
                    📂 my-express-app/<br>
                    ├── 📂 node_modules/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #64748b;">(โฟลเดอร์เก็บไลบรารีที่ติดตั้งผ่าน npm)</span><br>
                    ├── 📄 app.js &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #38bdf8; font-weight: bold;">(ไฟล์หลักในการตั้งค่าและรัน Server - บางที่ใช้ index.js)</span><br>
                    ├── 📄 package-lock.json<br>
                    └── 📄 package.json &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #64748b;">(ไฟล์ตั้งค่าโปรเจกต์และระบุว่าใช้ Express เวอร์ชันใด)</span>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🛣️ 2. การจัดการโครงสร้างเส้นทาง (Routing)</h3>
                <p><strong>Routing</strong> คือกระบวนการกำหนดว่าแอปพลิเคชันจะตอบสนองต่อ Endpoint (URL) ของฝั่ง Client อย่างไร โดยจะจับคู่ระหว่าง URL กับ <strong>HTTP Methods</strong> (หลักๆ ได้แก่ GET, POST, PUT, DELETE)</p>

                <table class="routing-table">
                    <thead>
                        <tr>
                            <th>HTTP Method</th>
                            <th>คำสั่งใน Express</th>
                            <th>จุดประสงค์ในการใช้งาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="method-badge method-get">GET</span></td>
                            <td><code class="inline-code">app.get()</code></td>
                            <td>ใช้สำหรับดึงข้อมูลหรือขอเปิดหน้าเว็บ (ไม่มีผลกระทบต่อข้อมูลบนเซิร์ฟเวอร์)</td>
                        </tr>
                        <tr>
                            <td><span class="method-badge method-post">POST</span></td>
                            <td><code class="inline-code">app.post()</code></td>
                            <td>ใช้สำหรับส่งข้อมูลใหม่ไปบันทึกบนเซิร์ฟเวอร์ (เช่น ส่งฟอร์มสมัครสมาชิก)</td>
                        </tr>
                        <tr>
                            <td><span class="method-badge method-put">PUT</span></td>
                            <td><code class="inline-code">app.put()</code></td>
                            <td>ใช้สำหรับส่งข้อมูลไปอัปเดตหรือแก้ไขข้อมูลเดิมที่มีอยู่แล้วบนเซิร์ฟเวอร์</td>
                        </tr>
                        <tr>
                            <td><span class="method-badge method-delete">DELETE</span></td>
                            <td><code class="inline-code">app.delete()</code></td>
                            <td>ใช้สำหรับสั่งลบข้อมูลออกจากเซิร์ฟเวอร์</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <h4>ตัวอย่างโค้ดการประกาศ Route รูปแบบต่างๆ:</h4>
                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Basic Routing)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const app = express();

// หน้าแรกของเว็บไซต์ (Root Route)
app.get('/', (req, res) => {
    res.send('ยินดีต้อนรับสู่หน้าแรกของเว็บเซิร์ฟเวอร์');
});

// หน้าเกี่ยวกับเรา (About Page)
app.get('/about', (req, res) => {
    res.send('หน้าแสดงข้อมูลเกี่ยวกับสถาบันการศึกษา');
});

// หน้าส่งข้อมูล (จำลอง POST Method)
app.post('/submit', (req, res) => {
    res.send('ได้รับข้อมูลจากฟอร์มเรียบร้อยแล้ว');
});</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🔍 3. การรับส่งค่าผ่าน URL Parameter และ Query String</h3>
                <p>ในการพัฒนาจริง เรามักต้องการรับค่าที่ Client แนบมาพร้อมกับ URL เพื่อไปประมวลผลต่อ เช่น รหัสสินค้า หรือคีย์เวิร์ดที่ต้องการค้นหา ซึ่งใน Express.js สามารถแบ่งออกได้เป็น 2 วิธีหลัก:</p>

                <br>
                <h4>3.1 URL Parameter (req.params)</h4>
                <p>คือการส่งค่าฝังไปในโครงสร้างเส้นทางเว็บ โดยสัญลักษณ์ที่ใช้บอก Express ว่าตรงนี้คือตัวแปร ให้ระบุด้วยเครื่องหมายโคลอน <strong><code class="inline-code">:</code></strong> นำหน้าชื่อตัวแปรนั้นๆ</p>
                <p style="font-size: 0.95rem; color: #2563eb; margin-bottom: 5px;">🔗 รูปแบบ URL: <code class="inline-code">/products/5001</code></p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (URL Parameter)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>// โค้ดฝั่ง Server ตั้งรับค่า :id
app.get('/products/:id', (req, res) => {
    // การดึงค่าออกมาใช้งานผ่าน req.params
    const productId = req.params.id; 
    res.send(`คุณกำลังเรียกดูข้อมูลของสินค้ารหัส: ${productId}`);
});

// กรณีมีหลาย Parameters ร่วมกัน
app.get('/users/:username/books/:bookId', (req, res) => {
    const user = req.params.username;
    const book = req.params.bookId;
    res.send(`ผู้ใช้: ${user} กำลังอ่านหนังสือรหัส: ${book}`);
});</code></pre>
                </div>

                <br>
                <h4>3.2 Query String (req.query)</h4>
                <p>คือการส่งข้อมูลต่อท้าย URL โดยใช้เครื่องหมายคำถาม <strong><code class="inline-code">?</code></strong> คั่นกลาง และส่งข้อมูลเป็นคู่ของ <code class="inline-code">key=value</code> หากมีมากกว่า 1 ค่าจะเชื่อมด้วยเครื่องหมายแอมเพอร์แซนด์ <strong><code class="inline-code">&amp;</code></strong> (ไม่ต้องตั้งค่าอะไรที่ฝั่ง Route เพิ่มเติม)</p>
                <p style="font-size: 0.95rem; color: #2563eb; margin-bottom: 5px;">🔗 รูปแบบ URL: <code class="inline-code">/search?keyword=node&amp;page=2</code></p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Query String)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>// ฝั่ง Route ประกาศแบบปกติ ไม่ต้องใส่เครื่องหมายโคลอน
app.get('/search', (req, res) => {
    // การดึงค่าออกมาใช้งานผ่าน req.query
    const searchWord = req.query.keyword;
    const pageNumber = req.query.page;
    
    res.send(`ผลการค้นหาคำว่า: ${searchWord} (อยู่ที่หน้าแสดงผลที่: ${pageNumber})`);
});</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 4. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> ระบบจำลองฐานข้อมูลประวัตินักศึกษาอย่างง่ายผ่าน Express Web API</p>
                <p><strong>วัตถุประสงค์:</strong> นักศึกษาสามารถติดตั้ง Express.js จัดการโครงสร้าง Route และประยุกต์ดึงข้อมูลจากตัวแปรมาแสดงผลผ่าน URL Parameter ได้ถูกต้อง</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> สร้างโฟลเดอร์โครงงานใหม่ในเครื่องชื่อ <code class="inline-code">express-routing-lab</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 2</span> เปิด Terminal เพื่อเริ่มต้นโครงงานและติดตั้ง Express Framework:</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm init -y
npm install express</code></pre>
                    </div>
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> สร้างไฟล์ชื่อ <code class="inline-code">app.js</code> และเขียนซอร์สโค้ดสร้างเว็บแอปพลิเคชันดังนี้:</p>
                </div>

                <div class="code-window" style="margin-top: 15px;">
                    <div class="code-header">
                        <span>javascript (app.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const app = express();
const PORT = 3000;

// จำลองชุดข้อมูลนักศึกษาในรูปแบบ Array ของ Object
const studentData = [
    { id: "1001", name: "สมชาย รักดี", major: "เทคโนโลยีซอฟต์แวร์", gpa: "3.75" },
    { id: "1002", name: "นางสาวสมศรี มีสุข", major: "เทคโนโลยีเครือข่าย", gpa: "2.80" },
    { id: "1003", name: "นายวิชาญ ใจกล้า", major: "เทคโนโลยีซอฟต์แวร์", gpa: "3.42" }
];

// 1. หน้าแรก (Root)
app.get('/', (req, res) => {
    res.send('<h1>ระบบฐานข้อมูลสถิตินักศึกษา (ยินดีต้อนรับ)</h1><p>กรุณาใช้งานผ่านพาร์ท /students หรือ /students/รหัสเพื่อค้นหา</p>');
});

// 2. ดึงข้อมูลนักศึกษาทั้งหมด
app.get('/students', (req, res) => {
    res.json(studentData); // ส่งข้อมูลกลับไปในรูปแบบ JSON (เหมาะสำหรับทำ API หลังบ้าน)
});

// 3. ค้นหานักศึกษาผ่าน URL Parameter (:stdId)
app.get('/students/:stdId', (req, res) => {
    const searchId = req.params.stdId;
    
    // ค้นหาข้อมูลใน Array ที่มี id ตรงกับที่ User ส่งมา
    const result = studentData.find(student => student.id === searchId);
    
    if (result) {
        res.json({
            status: "success",
            data: result
        });
    } else {
        res.status(404).json({
            status: "error",
            message: `ไม่พบข้อมูลนักศึกษารหัส ${searchId} ในระบบ`
        });
    }
});

// เริ่มเปิดใช้งาน Server บน Port ที่กำหนด
app.listen(PORT, () => {
    console.log(`🚀 เซิร์ฟเวอร์ Express พร้อมทำงานแล้วที่ http://localhost:${PORT}`);
});</code></pre>
                </div>

                <div style="margin-top: 15px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> รันระบบเซิร์ฟเวอร์โดยใช้คำสั่ง: <code class="inline-code">node app.js</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> เปิดเบราว์เซอร์แล้วทดสอบเรียกลิงก์:</p>
                    <ul style="margin-left: 30px;">
                        <li><a href="http://localhost:3000/students" target="_blank">http://localhost:3000/students</a> (ต้องเจอข้อมูลทั้ง 3 คน)</li>
                        <li><a href="http://localhost:3000/students/1002" target="_blank">http://localhost:3000/students/1002</a> (ต้องเจอข้อมูลนางสาวสมศรี)</li>
                        <li><a href="http://localhost:3000/students/9999" target="_blank">http://localhost:3000/students/9999</a> (ต้องขึ้นแจ้งสถานะไม่พบข้อมูล)</li>
                    </ul>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 4: ระบบกรองเกรดเฉลี่ยของนักศึกษาผ่าน Query String</strong></p>
                <br>
                <p><strong>คำสั่ง:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.7;">
                    <li>ให้นักศึกษาต่อยอดโค้ดไฟล์เดิมของตัวห้องปฏิบัติการ (<code class=\"inline-code\">app.js</code>)</li>
                    <li>เพิ่มเส้นทางใหม่ขึ้นมา 1 เส้นทาง คือพาร์ท <code class="inline-code">/students/filter</code></li>
                    <li>ให้ระบบความสามารถในการรับค่า Query String ตัวแปรชื่อว่า <code class="inline-code">minGpa</code></li>
                    <li>เมื่อผู้ใช้เรียกใช้ลิงก์ เช่น <code class="inline-code">/students/filter?minGpa=3.00</code> ตัวเซิร์ฟเวอร์จะต้องคำนวณและคืนค่ากลับมาเฉพาะข้อมูลวัตถุนักศึกษาที่มีเกรดเฉลี่ย<strong>มากกว่าหรือเท่ากับ</strong>เกรดที่ระบุเท่านั้นลงบนหน้าจอเบราว์เซอร์</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การตัดคะแนน (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• ความถูกต้องในโครงสร้างชุดคำสั่งและการรับค่าผ่านไอเทม <code class="inline-code">req.query</code> (2 คะแนน)</li>
                    <li>• การนำลอจิกเงื่อนไข (<code class="inline-code">if/filter</code>) มาคัดกรองข้อมูลอาร์เรย์ได้อย่างถูกต้อง (1 คะแนน)</li>
                    <li>• ความสมบูรณ์ของโค้ดโปรแกรมในการรันทำงาน โดยไม่มีคำสั่ง Error ทำระบบล่มค้าง (1 คะแนน)</li>
                    <li>• ความสะอาดของโค้ด สไตล์การเขียน และส่งงานตรงเวลานัดหมาย (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>