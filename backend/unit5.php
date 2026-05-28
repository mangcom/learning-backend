<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 5: Middleware & Request Data Parsing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* สไตล์เพิ่มเติมเฉพาะหน้าเพื่อรองรับเนื้อหาขนาดใหญ่ 2 สัปดาห์ */
        .middleware-flow {
            background-color: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .middleware-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .middleware-table th,
        .middleware-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            text-align: left;
            font-size: 0.95rem;
        }

        .middleware-table th {
            background-color: #1e293b;
            color: #fff;
            font-weight: 600;
        }

        .middleware-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .week-badge {
            display: inline-block;
            background-color: #dbeafe;
            color: #1e40af;
            font-size: 0.8rem;
            font-weight: bold;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 10px;
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

        .highlight-note {
            background-color: #fff7ed;
            border-left: 4px solid #ea580c;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>
    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">⬅ กลับสู่หน้าหลักวิชา</a>
            <h2>หน่วยที่ 5: Middleware & Request Data Parsing</h2>
            <p>สัปดาห์ที่ 5-6 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        หัวใจหลักที่ทำให้ Express.js มีความยืดหยุ่นสูงคือสถาปัตยกรรมแบบ <strong>Middleware (ซอฟต์แวร์กลาง)</strong> ซึ่งเปรียบเสมือนด่านตรวจหรือผู้กลั่นกรองข้อมูลที่ขวางกั้นอยู่ระหว่าง Request (คำร้องขอจากไคลเอนต์) และ Response (การตอบกลับจากเซิร์ฟเวอร์) การเข้าใจกลไกท่อส่งข้อมูล (Pipeline), การถอดรหัสและแปลงรูปแบบบอดี้ข้อมูล <strong>(Data Parsing)</strong> เช่น JSON หรือ URL-Encoded รวมถึงการออกแบบระบบความปลอดภัยและการจัดการข้อผิดพลาดด้วย Custom Middleware เป็นทักษะขั้นสูงที่จำเป็นสำหรับการพัฒนาสถาปัตยกรรมระบบหลังบ้านระดับมืออาชีพ
                    </p>
                </div>
            </section>

            <div style="text-align: center; margin: 40px 0 20px 0;">
                <span class="week-badge" style="font-size: 1rem; padding: 6px 20px;">📅 สัปดาห์ที่ 5: เจาะลึกสถาปัตยกรรม Middleware และการสร้าง Custom Middleware</span>
            </div>

            <section class="lesson-section">
                <h3>📑 1. แนวคิดและกลไกการทำงานของ Middleware</h3>
                <p>ใน Express.js แอปพลิเคชันประกอบไปด้วยฟังก์ชัน Middleware ต่อเรียงกันเป็นท่อส่งข้อมูล (Pipeline) โดยฟังก์ชัน Middleware ทุกตัวจะสามารถเข้าถึงออบเจกต์คำร้องขอ <code class="inline-code">req</code>, ออบเจกต์ส่งผลลัพธ์ <code class="inline-code">res</code> และฟังก์ชันถัดไปในวงจรที่เรียกว่า <code class="inline-code">next</code> ได้</p>

                <div class="middleware-flow">
                    <strong>🔄 ลำดับวงจรชีวิตข้อมูล (Request-Response Cycle):</strong><br>
                    ไคลเอนต์ส่ง Request ➔ <strong>Middleware ตัวที่ 1</strong> ➔ เรียก <code class="inline-code">next()</code> ➔ <strong>Middleware ตัวที่ 2</strong> ➔ เรียก <code class="inline-code">next()</code> ➔ <strong>Route Handler (ตัวปลายทาง)</strong> ➔ เซิร์ฟเวอร์ส่ง Response กลับ
                </div>

                <h4>1.1 หน้าที่หลักของ Middleware</h4>
                <p>Middleware สามารถเขียนขึ้นมาเพื่อทำหน้าที่สำคัญๆ ได้ดังนี้:</p>
                <ul style="margin-left: 20px; margin-top: 10px; line-height: 1.8;">
                    <li><strong>Execute Code:</strong> รันคำสั่งโค้ดใดๆ ก็ได้ เช่น การบันทึกข้อมูลสถิติลงไฟล์ระบบ (Logging)</li>
                    <li><strong>Modify Objects:</strong> เปลี่ยนแปลงหรือเพิ่มคุณสมบัติให้ให้ออบเจกต์ <code class="inline-code">req</code> และ <code class="inline-code">res</code> (เช่น แอบใส่ข้อมูลผู้ใช้ที่ล็อกอินเข้าไปใน <code class="inline-code">req.user</code>)</li>
                    <li><strong>End Cycle:</strong> จบวงจรชีวิตการทำงานและส่ง Response กลับทันทีโดยไม่ให้ผ่านไปหาด่านถัดไป (เช่น เมื่อตรวจสอบพบว่าผู้ใช้ไม่มีสิทธิ์เข้าถึงหน้าเว็บนั้น)</li>
                    <li><strong>Call Next:</strong> ส่งต่องานให้กับ Middleware ตัวถัดไปในระบบผ่านฟังก์ชัน <code class="inline-code">next()</code></li>
                </ul>

                <div class="highlight-note">
                    <strong>⚠️ ข้อควรระวังขั้นวิกฤต:</strong> หาก Middleware ของคุณไม่ทำลายวงจรด้วยการส่งคำสั่งกลับไปหาไคลเอนต์ (เช่น <code class="inline-code">res.send()</code>) คุณ <strong>จำเป็นต้องเรียก <code class="inline-code">next()</code> เสมอ</strong> มิฉะนั้นเบราว์เซอร์ของไคลเอนต์จะเกิดอาการหมุนค้าง (Hang) เนื่องจากเซิร์ฟเวอร์ไม่ส่งผลลัพธ์และไม่ยอมเดินหน้าต่อ
                </div>
            </section>

            <section class="lesson-section">
                <h3>🛠️ 2. การสร้างและประยุกต์ใช้งาน Custom Middleware</h3>
                <p>เราสามารถเขียน Middleware ขึ้นมาใช้เองได้ง่ายๆ โดยการสร้างฟังก์ชันที่มีพารามิเตอร์ 3 ตัว ได้แก่ <code class="inline-code">(req, res, next)</code> จากนั้นนำไปติดตั้งเข้าระบบผ่านคำสั่ง <code class="inline-code">app.use()</code></p>

                <br>
                <h4>2.1 โค้ดตัวอย่าง: สร้างระบบบันทึกเวลาที่ Request เข้ามา (Application-Level Middleware)</h4>
                <p>Middleware รูปแบบนี้จะถูกรันทุกครั้งที่มีคนเรียกเข้าลิงก์ใดๆ ก็ตามบนเซิร์ฟเวอร์ของเรา:</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Application-Level Middleware)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const app = express();

// 1. นิยามฟังก์ชัน Custom Middleware สำหรับเก็บประวัติการเรียกดูเว็บ
const requestLogger = (req, res, next) => {
    const currentMethod = req.method; //ดึงประเภท HTTP Method เช่น GET, POST
    const currentUrl = req.url;       //ดึงพาร์ท URL ที่เรียกเข้ามา
    const timestamp = new Date().toISOString();
    
    console.log(`[${timestamp}] มีคำร้องขอประเภท ${currentMethod} วิ่งมาที่พาร์ท ${currentUrl}`);
    
    next(); // 🌟 สำคัญมาก! สั่งเดินหน้าต่อไปยัง Route ปลายทาง
};

// 2. สั่งให้แอปพลิเคชันใช้งาน Middleware นี้กับทุกๆ หน้าเว็บ
app.use(requestLogger);

app.get('/', (req, res) => {
    res.send('หน้าหลัก (Home Page)');
});

app.get('/dashboard', (req, res) => {
    res.send('หน้าแดชบอร์ดระบบ');
});</code></pre>
                </div>

                <br>
                <h4>2.2 โค้ดตัวอย่าง: สร้าง Middleware ตรวจสอบสิทธิ์เฉพาะพาร์ท (Router-Level Middleware)</h4>
                <p>ในหลายๆ สถานการณ์ เราต้องการดักตรวจข้อมูลเฉพาะบางเส้นทางเท่านั้น เช่น หน้าลับเฉพาะแอดมิน เราสามารถส่งฟังก์ชัน Middleware แนบเข้าไปในคำสั่ง Route นั้นๆ ได้โดยตรง:</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (Specific Route Middleware)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>// ฟังก์ชันเช็กสิทธิ์แอดมินผ่าน Query String ลิงก์
const adminGuard = (req, res, next) => {
    const userRole = req.query.role; // สมมติเรียก: /admin/setting?role=admin
    
    if (userRole === 'admin') {
        next(); // ผ่านด่านได้ ยอมให้ไปทำคำสั่งในบรรทัดถัดไป
    } else {
        // ทำลายวงจรทันที ส่งสเตตัส 403 (Forbidden) บล็อกไม่ให้เข้าระบบ
        res.status(403).send('❌ ปฏิเสธการเข้าถึง: หน้านี้เข้าใช้งานได้เฉพาะสิทธิ์ Admin เท่านั้น!');
    }
};

// นำไปแปะดักทางเข้าเฉพาะ Route ลับ
app.get('/admin/setting', adminGuard, (req, res) => {
    res.send('ยินดีต้อนรับท่านผู้ดูแลระบบ เข้าสู่หน้าจัดการการตั้งค่าหลังบ้าน');
});</code></pre>
                </div>
            </section>

            <hr style="margin: 50px 0; border: 0; border-top: 2px solid #cbd5e1;">

            <div style="text-align: center; margin: 20px 0;">
                <span class="week-badge" style="font-size: 1rem; padding: 6px 20px; background-color: #fef3c7; color: #92400e;">📅 สัปดาห์ที่ 6: กระบวนการ Parse ข้อมูลบอดี้ และการรับส่งข้อมูล POST Method</span>
            </div>

            <section class="lesson-section">
                <h3>📦 3. กระบวนการย่อยข้อความบอดี้ (Request Data Parsing)</h3>
                <p>เวลาที่ไคลเอนต์ส่งข้อมูลจำนวนมากมาหาเซิร์ฟเวอร์ผ่าน HTTP <span style="color: #3b82f6; font-weight: bold;">POST</span> หรือ <span style="color: #f59e0b; font-weight: bold;">PUT</span> ข้อมูลเหล่านั้นจะถูกบรรจุมาในส่วนเนื้อหาที่เรียกว่า <strong>Request Body</strong> ซึ่ง Node.js/Express จะรับมาเป็นสายสตรีมข้อมูลดิบ (Raw Data Stream) ที่ยังไม่พร้อมใช้งาน นักพัฒนาจึงต้องใช้ Middleware ชนิดพิเศษที่ทำหน้าที่แปลงสตรีมดิบเหล่านั้นให้กลายเป็นออบเจกต์ JavaScript ที่ดึงมาใช้ง่ายๆ ผ่าน <code class="inline-code">req.body</code></p>

                <h4>3.1 โมดูล Built-in Body Parser ใน Express ยุคปัจจุบัน</h4>
                <p>ตั้งแต่ Express เวอร์ชัน 4.16.0 เป็นต้นมา ตัวเฟรมเวิร์กได้แถมโมดูลย่อยข้อมูลมาให้ในตัว โดยที่เราไม่ต้องไปดาวน์โหลดแพ็กเกจภายนอกมาติดตั้งเพิ่ม ซึ่งมีอยู่ 2 แบบที่ต้องประกาศใช้บ่อยที่สุด:</p>

                <table class="middleware-table">
                    <thead>
                        <tr>
                            <th>ชุดคำสั่งประกาศเปิดใช้งาน</th>
                            <th>ประเภทข้อมูลที่รองรับและใช้เคลียร์ค่า</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="inline-code">app.use(express.json());</code></td>
                            <td>ดักย่อยข้อมูลที่ส่งมาในรูปแบบโครงสร้างสัญกรณ์ <strong>JSON Data</strong> (นิยมมากที่สุดในการสร้างแอปพลิเคชันรูปแบบ Web API ทันสมัย หรือส่งมาจากพวก React, Vue)</td>
                        </tr>
                        <tr>
                            <td><code class="inline-code">app.use(express.urlencoded({ extended: true }));</code></td>
                            <td>ดักย่อยข้อมูลที่ถูกส่งมาจากฟอร์ม HTML ดั้งเดิมรูปแบบ <strong>URL-Encoded Form Data</strong> (เช่น ฟอร์มล็อกอินทั่วไปที่มีช่อง Input ทั่วไปและกดปุ่ม Submit) ค่า <code class="inline-code">extended: true</code> สั่งให้ใช้ไลบรารี <code class="inline-code">qs</code> ช่วยทำให้รองรับการส่งข้อมูลอาเรย์ที่ซับซ้อนได้</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="lesson-section">
                <h3>💻 4. ห้องปฏิบัติการฝึกฝนแบบบูรณาการ (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> ระบบลงทะเบียนสมัครสมาชิกและการคัดกรองความปลอดภัยของข้อมูลหลังบ้าน</p>
                <p><strong>วัตถุประสงค์:</strong> นักศึกษาสามารถเปิดระบบดักรับข้อมูลผ่านโครงสร้างบอดี้แพลตฟอร์ม และเขียน Custom Middleware ตรวจความปลอดภัยร่วมกันได้อย่างสมบูรณ์แบบ</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> สร้างโฟลเดอร์โครงงานระบบใหม่ชื่อ <code class="inline-code">express-middleware-lab</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 2</span> เปิดหน้าต่าง Terminal ดำเนินการติดตั้ง Express โครงสร้างเริ่มต้น:</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm init -y
npm install express</code></pre>
                    </div>
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> สร้างไฟล์ซอร์สหลังบ้านหลักชื่อ <code class="inline-code">server.js</code> และระบุชุดรหัสโปรแกรมดังนี้:</p>
                </div>

                <div class="code-window" style="margin-top: 15px;">
                    <div class="code-header">
                        <span>javascript (server.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const app = express();
const PORT = 5000;

// 🔔 เปิดใช้งานโมดูล Parsing ข้อมูล (ต้องประกาศไว้ด้านบนสุดก่อนพวก Route เสมอ!)
app.use(express.json()); // รองรับ JSON Body
app.use(express.urlencoded({ extended: true })); // รองรับข้อมูลจากฟอร์ม HTML

// 🛡️ สร้าง Custom Middleware คอยดักตรวจความปลอดภัย (Validation Check)
const validateRegisterForm = (req, res, next) => {
    const { username, email, password } = req.body; // ดึงค่าจาก req.body ออกมาตรวจสอบ
    
    // ตรวจสอบเงื่อนไขว่าผู้เรียนกรอกข้อมูลครบถ้วนหรือไม่
    if (!username || !email || !password) {
        return res.status(400).json({
            status: "fail",
            message: "❌ ข้อมูลไม่ครบถ้วน: กรุณากรอกชื่อผู้ใช้, อีเมล และรหัสผ่านให้ครบทุกช่อง"
        });
    }
    
    // ตรวจสอบความยาวของรหัสผ่านเพื่อป้องกันภัยคุกคาม
    if (password.length &lt; 6) {
        return res.status(400).json({
            status: "fail",
            message: "❌ ความปลอดภัยต่ำ: รหัสผ่านจำเป็นต้องมีความยาวอย่างน้อย 6 ตัวอักษรขึ้นไป"
        });
    }
    
    // หากผ่านด่านตรวจสอบทุกข้อ ให้ส่งข้อมูลไปทำงานขั้นตอนถัดไป
    next();
};

// 📌 สร้าง Endpoint รับสมัครข้อมูลสมาชิกใหม่ (POST Method)
app.post('/api/register', validateRegisterForm, (req, res) => {
    // โค้ดในบล็อกนี้จะทำงานได้ก็ต่อเมื่อข้อมูลผ่านด่านย่อยใน validateRegisterForm มาแล้วเท่านั้น
    const { username, email } = req.body;
    
    console.log(`✨ บันทึกผู้ใช้ใหม่เข้าระบบสำเร็จ: ${username} (${email})`);
    
    res.status(201).json({
        status: "success",
        message: "🎉 บันทึกข้อมูลและลงทะเบียนสมาชิกรายใหม่เสร็จสมบูรณ์เรียบร้อยแล้ว!",
        user: {
            username: username,
            email: email
        }
    });
});

app.listen(PORT, () => {
    console.log(`🚀 API เซิร์ฟเวอร์ทดสอบทำงานเต็มระบบแล้วที่ลิงก์ http://localhost:${PORT}`);
});</code></pre>
                </div>

                <div style="margin-top: 15px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> สั่งรันโปรแกรมผ่าน Terminal: <code class="inline-code">node server.js</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> เนื่องจากระบบใช้เมธอด <strong style="color: #3b82f6;">POST</strong> ไม่สามารถพิมพ์ทดสอบตรงๆ บนยูอาร์แอลเบราว์เซอร์ได้ ให้นักศึกษาหันไปเปิดใช้งานโปรแกรม <strong>Postman</strong> เพื่อทดสอบระบบส่งค่าจำลองตามกระบวนการดังนี้:</p>
                    <ul style="margin-left: 35px; list-style-type: square;">
                        <li>ปรับ HTTP Method ให้เป็น <code class="inline-code" style="color: #3b82f6; font-weight: bold;">POST</code> และระบุลิงก์เป็น <code class="inline-code">http://localhost:5000/api/register</code></li>
                        <li>เลือกแท็บ <strong>Body</strong> ➔ เลือกรูปแบบการส่งเป็น <strong>raw</strong> ➔ ปรับประเภทชนิดข้อความเป็น <strong>JSON</strong></li>
                        <li>เขียนข้อความ JSON ทดสอบกรณีส่งข้อมูลสมบูรณ์:</li>
                    </ul>
                    <div class="code-window" style="margin-left: 35px; width: calc(100% - 35px); margin-top: 5px;">
                        <pre><code>{
    "username": "anucha_dev",
    "email": "anucha@school.ac.th",
    "password": "secretPassword123"
}</code></pre>
                    </div>
                    <ul style="margin-left: 35px; list-style-type: square; margin-top: 10px;">
                        <li>กดปุ่ม <strong>Send</strong> สังเกตผลลัพธ์ตอบกลับสถานะ 201 และทดลองปรับแก้ไขข้อมูลรหัสผ่านให้สั้นกว่า 6 ตัวเพื่อทดสอบการทำงานของด่าน Custom Middleware ป้องกันความปลอดภัย</li>
                    </ul>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 5: ระบบดักกรองการส่งข้อมูลราคาสินค้าหลังบ้าน (E-Commerce Product Guard)</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษาเพิ่มพาร์ทโครงงานใหม่โดยใช้เมธอด <code class="inline-code" style="color: #3b82f6; font-weight: bold;">POST</code> ไปที่เอนพอยต์ลิงก์ชื่อ <code class="inline-code">/api/products</code></li>
                    <li>ข้อมูลตัวแปรบอดี้ดิบที่ต้องรองรับการ Parse ประกอบไปด้วย <strong>productName (ชื่อสินค้า), price (ราคาสินค้า), และ stock (จำนวนสินค้า)</strong></li>
                    <li>ให้นักศึกษาเขียนสร้าง Custom Middleware ขึ้นมาดักทางตัวแปรนี้ชื่อว่า <code class="inline-code">checkProductPrice</code> เพื่อตรวจสอบเงื่อนไขดังต่อไปนี้:
                        <ol style="margin-left: 25px; margin-top: 5px;">
                            <li>หากราคาสินค้า (<code class="inline-code">price</code>) หรือจำนวนคลัง (<code class="inline-code">stock</code>) มีค่า<strong>ต่ำกว่าหรือเท่ากับ 0</strong> ให้ทำการสั่งยกเลิกวงจรทันที และส่งสเตตัสแจ้งตอบกลับไคลเอนต์เป็นรหัสความผิดพลาด <code class="inline-code">400 Bad Request</code> พร้อมข้อความแจ้งเตือนสีแดง</li>
                            <li>หากผ่านเงื่อนไขข้อมูลถูกต้อง ให้ส่งไปที่ส่วนปลายทางเพื่อพิมพ์รายงานผลการสร้างสินค้าชิ้นใหม่รูปแบบ JSON แสดงค่าข้อมูลทั้งหมดออกไปทางหน้าต่างผลลัพธ์ระบบ</li>
                        </ol>
                    </li>
                    <li>ให้ทดสอบการบันทึกทั้งกรณีที่ข้อมูลผ่านและไม่ผ่านเงื่อนไข รวบรวมภาพสกรีนช็อตของหน้าต่างแอปพลิเคชัน Postman อัปโหลดจัดทำส่งรายงานประมวลผลการเรียนรู้</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• ความถูกต้องในการตั้งโครงสร้างและประกาศใช้ Middleware สั่งย่อยข้อมูล Parse บอดี้ได้ถูกต้อง (1.5 คะแนน)</li>
                    <li>• ลอจิกเงื่อนไขและการใช้คำสั่ง <code class="inline-code">next()</code> หรือการตัดทำลายวงจรตอบกลับเมื่อพบเงื่อนไขผิดพลาด (1.5 คะแนน)</li>
                    <li>• ความสมบูรณ์ของโค้ดระบบ สามารถทดสอบรันส่งงานได้คล่องตัว ไร้ปัญหาจุดบกพร่องค้างระบบ (1 คะแนน)</li>
                    <li>• ความละเอียดรอบคอบของการส่งผลการทดลองหน้าตาผลลัพธ์ Postman ครบถ้วนและส่งตรงตามเวลา (1.0 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>