<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 2: Advanced JavaScript ES6+ for Back-End</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">
                <span class="arrow-icon">⬅</span>
                <span>กลับสู่หน้าหลักวิชา</span>
            </a>
            <h2>หน่วยที่ 2: Advanced JavaScript ES6+ for Back-End</h2>
            <p>สัปดาห์ที่ 2 | เวลาเรียน 5 ชั่วโมง (ทฤษฎี 1 ชม. ปฏิบัติ 4 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญ (Key Concepts)</strong>
                    <p>
                        ไวยากรณ์ JavaScript ยุคใหม่ (ES6+) เป็นรากฐานสำคัญสูงสุดในการพัฒนาซอฟต์แวร์ฝั่งหลังบ้านด้วย Node.js การเขียนโค้ดเพื่อควบคุมตรรกะเซิร์ฟเวอร์ที่มีประสิทธิภาพจำเป็นต้องอาศัยฟีเจอร์ระดับสูง เช่น Arrow Functions, Destructuring, และระบบ Modules นอกจากนี้ กลไกการทำงานของ Node.js ที่เป็นแบบ Single-threaded Non-blocking I/O บังคับให้นักพัฒนาต้องเชี่ยวชาญการเขียนโปรแกรมเชิงอซิงโครนัส (Asynchronous Programming) ผ่าน Promises และ Async/Await เพื่อป้องกันการเกิดคอขวด (Blocking) ของระบบ และรองรับปริมาณทราฟฟิกพร้อม ๆ กันได้อย่างเสถียรตามมาตรฐานสากล
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>🎯 จุดประสงค์การเรียนรู้ (Learning Objectives)</h3>
                <p>เมื่อนักศึกษาเรียนจบหน่วยการเรียนรู้นี้แล้ว จะมีความรู้ความสามารถดังนี้:</p>
                <table class="grading-table" style="margin-top: 15px;">
                    <tr>
                        <th width="25%">โดเมนการเรียนรู้</th>
                        <th>รายละเอียดจุดประสงค์การเรียนรู้</th>
                    </tr>
                    <tr>
                        <td><strong>ด้านความรู้ (Knowledge - K)</strong></td>
                        <td>1. สามารถอธิบายความแตกต่างและการทำงานของ Arrow Functions เทียบกับแบบดั้งเดิมได้<br>2. สามารถระบุความแตกต่างระหว่างระบบ CommonJS (require) และ ES Modules (import) ได้ถูกต้อง<br>3. อธิบายกลไกและลำดับการทำงานแบบ Asynchronous (Callback, Promise, Async/Await) ได้</td>
                    </tr>
                    <tr>
                        <td><strong>ด้านทักษะ (Practice - P)</strong></td>
                        <td>1. สามารถประยุกต์ใช้ Destructuring, Spread, และ Rest Operator ในการจัดการข้อมูลวัตถุได้<br>2. สามารถเขียนซอร์สโค้ดแบบ Asynchronous ด้วย Async/Await ควบคู่กับ Try/Catch ดักจับ Error ได้สำเร็จ</td>
                    </tr>
                    <tr>
                        <td><strong>ด้านเจตคติ (Attitude - A)</strong></td>
                        <td>1. ปฏิบัติงานเขียนโค้ดด้วยความละเอียดรอบคอบตามมาตรฐาน Clean Code ของแอปพลิเคชันสมัยใหม่<br>2. มีวิริยะอุตสาหะในการแก้ปัญหาตรรกะแบบลำดับเวลาอซิงโครนัสเพื่อป้องกันสภาวะ Race Conditions</td>
                    </tr>
                </table>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>📘 3. เนื้อหาทางทฤษฎีเชิงลึก (Theoretical Core)</h3>

                <h4 class="topic-title">เรื่องที่ 2.1: ไวยากรณ์ JavaScript ยุคใหม่ (Modern Syntax & Arrow Functions)</h4>
                <p>
                    ในการพัฒนาสถาปัตยกรรมหลังบ้าน โค้ดที่กระชับและลดผลข้างเคียงของขอบเขตตัวแปร (Lexical Scope) มีผลอย่างมากต่อเสถียรภาพ ตัวแปรชนิด <code>let</code> และ <code>const</code> เข้ามาแทนที่ <code>var</code> เพื่อควบคุมสโคปแบบ Block-scoped ในขณะที่ <strong>Arrow Functions</strong> ช่วยเปลี่ยนรูปแบบการประกาศฟังก์ชันให้สั้นลง และไม่มีสิทธิ์ผูกมัดค่า <code>this</code> ของตนเอง ทำให้ทำงานร่วมกับ Array Methods (เช่น map, filter, reduce) ได้ดีเยี่ยม
                </p>
                <p>
                    นอกจากนี้การสกัดข้อมูลจากอาร์เรย์และออบเจกต์ด้วย <strong>Destructuring Assignment</strong> ช่วยให้นักพัฒนาหลังบ้านสามารถแกะค่า Metadata หรือ Request Body ที่ผู้ใช้ส่งเข้ามาได้อย่างเป็นระเบียบและรวดเร็ว
                </p>

                <h4 class="topic-title">เรื่องที่ 2.2: ระบบสถาปัตยกรรมโมดูล (CommonJS vs ES Modules)</h4>
                <p>
                    การทำงานฝั่งหลังบ้านจำเป็นต้องมีการแบ่งไฟล์ตรรกะแยกย่อยออกเป็นโมดูลต่าง ๆ (Modularization) เพื่อให้ง่ายต่อการซ่อมบำรุงและทดสอบระบบ ในสิ่แวดล้อม Node.js มีระบบโมดูลหลักอยู่ 2 มาตรฐาน:
                </p>
                <table class="grading-table" style="margin: 15px 0;">
                    <tr style="background:#f1f5f9;">
                        <th>คุณลักษณะ</th>
                        <th>CommonJS (CJS)</th>
                        <th>ES Modules (ESM)</th>
                    </tr>
                    <tr>
                        <td><strong>รูปแบบคำสั่งหลัก</strong></td>
                        <td>ใช้ <code>require()</code> และ <code>module.exports</code></td>
                        <td>ใช้ <code>import</code> และ <code>export default / const</code></td>
                    </tr>
                    <tr>
                        <td><strong>กลไกการโหลดข้อมูล</strong></td>
                        <td>Synchronous (โหลดไฟล์ตามลำดับทันที)</td>
                        <td>Asynchronous (วิเคราะห์โครงสร้างไฟล์ก่อนทำงาน)</td>
                    </tr>
                    <tr>
                        <td><strong>สภาพแวดล้อมเริ่มต้น</strong></td>
                        <td>เป็นค่าเริ่มต้นดั้งเดิมของ Node.js (ไฟล์ .js)</td>
                        <td>มาตรฐานเว็บสากลปัจจุบัน (เปิดใช้เมื่อตั้งค่า "type": "module")</td>
                    </tr>
                </table>

                <h4 class="topic-title">เรื่องที่ 2.3: กลไกการประมวลผลอซิงโครนัส (Asynchronous Patterns)</h4>
                <p>
                    เนื่องจาก Node.js มีสถาปัตยกรรมเป็น Event-Driven ที่ทำงานแบบซิงเกิลเธรด งานบางประเภทเช่น การคิวรีฐานข้อมูล (Database Query), การอ่านไฟล์ขนาดใหญ่ (File I/O) หรือการยิง Request ไปยัง Server อื่น (API Fetching) จะใช้เวลาประมวลผลนาน หากใช้คำสั่งซิงโครนัสทั่วไป จะทำให้ทั้งเซิร์ฟเวอร์หยุดชะงัก (Block) ไม่สามารถรับ Request ของผู้ใช้คนอื่นได้
                </p>

                <blockquote>
                    <strong>💡 เจาะลึกทางทฤษฎี: ลำดับวิวัฒนาการโค้ดอซิงโครนัส (Asynchronous Evolution)</strong><br>
                    • <strong>Callback Functions:</strong> เป็นวิธีดั้งเดิม แต่ถ้าระบบซับซ้อนจะเกิดปัญหาโค้ดซ้อนกันเป็นรูปพีระมิดลึก หรือที่เรียกว่า <em>Callback Hell</em> ทำให้บักเกิดขึ้นง่ายและอ่านโค้ดยากมาก<br>
                    • <strong>Promises:</strong> เป็นออบเจกต์ตัวแทนของผลลัพธ์ที่จะเกิดขึ้นในอนาคต มี 3 สถานะคือ Pending (รอดำเนินการ), Fulfilled (สำเร็จ - ส่งค่าทาง .then()) และ Rejected (ล้มเหลว - ส่งค่าทาง .catch())<br>
                    • <strong>Async/Await:</strong> มาตรฐานสูงสุดในปัจจุบัน เป็นการเขียนโค้ดอซิงโครนัสให้ออกมาเป็นรูปแบบโค้ดซิงโครนัสบรรทัดต่อบรรทัด ทำให้โปรแกรมอ่านง่าย ปลอดภัย และดักจับ Error ได้อย่างสวยงามผ่านบล็อก Try/Catch
                </blockquote>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🛠️ 4. ตัวอย่างการปฏิบัติการทีละขั้นตอน (Step-by-Step Walkthrough)</h3>
                <p>ในบทปฏิบัติการนี้ นักศึกษาจะได้ทดลองฝึกเขียนโปรแกรมควบคุม JavaScript ES6+ ขั้นสูง และจำลองกลไกการดึงข้อมูลจากระบบฐานข้อมูลหลังบ้านแบบ Asynchronous</p>

                <div class="step-box">
                    <div class="step-num">ขั้นตอนที่ 1</div>
                    <div class="step-detail">
                        <strong>สร้างโฟลเดอร์ปฏิบัติการและเตรียมระบบฝึกเขียนโค้ด</strong>
                        <p>เปิด Terminal ในโปรแกรม VS Code แล้วทำการสร้างไฟล์ JavaScript สำหรับการเรียนรู้ฟีเจอร์ ES6 Modern Syntax ดำเนินการพิมพ์คำสั่งดังต่อไปนี้:</p>

                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">PowerShell</span>
                                <button class="copy-icon-btn" onclick="copyCode(this)" title="คัดลอกโค้ด">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                            </div>
                            <pre>mkdir backend-unit2
cd backend-unit2
code -r es6-features.js</pre>
                        </div>
                    </div>
                </div>

                <div class="step-box">
                    <div class="step-num">ขั้นตอนที่ 2</div>
                    <div class="step-detail">
                        <strong>ฝึกใช้งาน Arrow Function และ Destructuring สำหรับการรับส่งข้อมูล API</strong>
                        <p>เขียนโค้ดลงในไฟล์ <code>es6-features.js</code> เพื่อศึกษาการแกะค่าออบเจกต์จำลองจาก Request Body และการยับยั้งการใช้คำสั่งฟังก์ชันแบบเก่า:</p>

                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">JavaScript</span>
                                <button class="copy-icon-btn" onclick="copyCode(this)" title="คัดลอกโค้ด">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                            </div>
                            <pre>// จำลองข้อมูล Object ที่มักรับมาจากข้อมูลผู้ใช้ (req.body)
const userRequest = {
    username: 'pornchai_tk',
    role: 'Instructor',
    college: 'Bangna Commercial College',
    skills: ['Node.js', 'Express', 'MongoDB']
};

// 1. การประยุกต์ใช้ Destructuring Assignment แกะข้อมูลในบรรทัดเดียว
const { username, role, college } = userRequest;

// 2. การสร้างฟังก์ชันแบบ Arrow Function ร่วมกับ Template Literals (`)
const generateWelcomeMessage = (name, position) => {
    return `สวัสดีครับคุณครู ${name} ตำแหน่ง ${position} ยินดีต้อนรับสู่เซิร์ฟเวอร์ระบบปฏิบัติการวิชาเทคโนโลยี Back-End`;
};

// แสดงผลตรวจสอบข้อมูลใน Console
console.log(generateWelcomeMessage(username, role));
console.log(`สถานศึกษาต้นสังกัด: ${college}`);</pre>
                        </div>
                        <p>ทดสอบรันด้วยคำสั่ง <code>node es6-features.js</code> เพื่อดูการพิมพ์ค่าข้อมูลใน Terminal</p>
                    </div>
                </div>

                <div class="step-box">
                    <div class="step-num">ขั้นตอนที่ 3</div>
                    <div class="step-detail">
                        <strong>การจัดการตรรกะเวลาและข้อผิดพลาดฐานข้อมูลด้วย Async/Await</strong>
                        <p>สร้างไฟล์ใหม่ขึ้นมาชื่อ <code>async-demo.js</code> จากนั้นเขียนสคริปต์จำลองการดึงข้อมูลจากระบบฐานข้อมูลคลาวด์ ซึ่งเป็นกระบวนการแบบอซิงโครนัสที่มีโอกาสเกิดข้อผิดพลาดเครือข่ายได้:</p>

                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">JavaScript</span>
                                <button class="copy-icon-btn" onclick="copyCode(this)" title="คัดลอกโค้ด">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                            </div>
                            <pre>// 1. ฟังก์ชันจำลองการดึงข้อมูลสินค้าจาก Database (ใช้ Promise ร่วมกับ setTimeout)
const fetchProductFromDatabase = (productId) => {
    return new Promise((resolve, reject) => {
        console.log("⏳ กำลังเชื่อมต่อเครือข่ายคิวรีฐานข้อมูล NoSQL...");
        
        setTimeout(() => {
            const isNetworkConnected = true; // สมมติสถานะเครือข่ายเว็บ
            if (isNetworkConnected) {
                resolve({ id: productId, productName: 'Express Server License', price: 2500 });
            } else {
                reject('❌ เกิดข้อผิดพลาด: ไม่สามารถเชื่อมต่อกับ Database Cluster ได้');
            }
        }, 2000); // จำลองเวลาหน่วงการตอบรับของเซิร์ฟเวอร์ 2 วินาที
    });
};

// 2. ฟังก์ชันควบคุมระบบหลักด้วยกลไก Async/Await ร่วมกับสถาปัตยกรรมดักจับข้อผิดพลาด Try/Catch
const startServerProcess = async () => {
    try {
        console.log("🚀 เริ่มต้นกระบวนการร้องขอข้อมูลหลังบ้าน...");
        
        // รอให้กระบวนการดึงข้อมูลสำเร็จก่อน (Non-blocking I/O Wait)
        const productData = await fetchProductFromDatabase("PRO-31901");
        
        console.log("✅ ดึงข้อมูลสำเร็จลุล่วง!");
        console.log(`สินค้าที่ค้นพบ: ${productData.productName} - ราคา: ${productData.price} บาท`);
        
    } catch (error) {
        // หากฝั่ง Promise คืนค่าล้มเหลว (reject) จะเด้งเข้ามาทำงานที่บล็อกนี้ทันที
        console.error("⚠️ ตรวจพบระบบขัดข้องศูนย์กลาง:");
        console.error(error);
    } finally {
        console.log("🔚 สิ้นสุดสเตจการประมวลผลคำสั่งหลังบ้านอย่างสมบูรณ์");
    }
};

// รันฟังก์ชันกระบวนการ
startServerProcess();</pre>
                        </div>
                    </div>
                </div>

                <div class="step-box">
                    <div class="step-num">ขั้นตอนที่ 4</div>
                    <div class="step-detail">
                        <strong>การตรวจสอบประเมินผลผ่านเครือข่าย Terminal</strong>
                        <p>เปิด Terminal แล้วสั่งรันไฟล์จำลองระบบด้วยคำสั่ง:</p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">PowerShell</span>
                                <button class="copy-icon-btn" onclick="copyCode(this)" title="คัดลอกโค้ด">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                            </div>
                            <pre>node async-demo.js</pre>
                        </div>
                        <p>ให้นักศึกษาสังเกตดูการเรียงลำดับพิมพ์ข้อความของระบบ โค้ดจะหยุดรอเวลา 2 วินาทีเพื่อให้ฐานข้อมูลส่งข้อมูลกลับมาสำเร็จก่อน จึงจะทำการปริ้นต์ข้อความในคำสั่งบรรทัดถัดไปตามสไตล์การเขียนแอปพลิเคชันเสถียรภาพสูง</p>
                    </div>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 2: การพัฒนาสคริปต์อซิงโครนัสและระบบดักจับความปลอดภัยข้อมูลลูกค้า</strong></p>
                <br>
                <p><strong>คำสั่ง:</strong></p>
                <ul style="margin-left: 20px;">
                    <li>ให้นักศึกษาสร้างสคริปต์จาวาสคริปต์ไฟล์ใหม่ชื่อ <code class="inline-code">assignment2.js</code></li>
                    <li>ให้เขียนฟังก์ชันแบบ Arrow Function ชื่อว่า <code>verifyUserAccess(score)</code> โดยส่งค่ากลับมาเป็น Promise จำลองเวลาดักจับข้อมูล 1.5 วินาที</li>
                    <li><strong>เงื่อนไขคะแนนสิทธิ์:</strong> ถ้าค่าตัวเลข score ที่ป้อนเข้ามามีค่าตั้งแต่ 50 ขึ้นไปให้ส่ง <code>resolve('สิทธิ์การเข้าถึงผ่านระบบรักษาความปลอดภัยสำเร็จ')</code> แต่ถ้าคะแนนต่ำกว่า 50 ให้ส่ง <code>reject('⚠️ สิทธิ์การเข้าถึงถูกปฏิเสธ: คะแนนการตรวจสอบไม่เพียงพอ')</code></li>
                    <li>ให้เขียนฟังก์ชันควบคุมหลักเป็นแบบ <code>async / await</code> พร้อมใช้ <code>try/catch</code> เพื่อรับและพิมพ์ข้อความผลลัพธ์ทั้งกรณีผ่านและไม่ผ่านออกทางหน้าจอ</li>
                    <li>ให้ทดลองรันตัวสคริปต์ทั้งสองกรณี แคปเจอร์ภาพหน้าจอผลลัพธ์บน Terminal นำส่งในระบบตามเวลาที่ครูกำหนด</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การตัดคะแนน (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• ความถูกต้องในการประยุกต์โครงสร้างสคริปต์ Promise และ Arrow Function (2 คะแนน)</li>
                    <li>• มีการใช้งานโครงสร้าง Async/Await คู่กับบล็อก Try/Catch ได้สมบูรณ์ตรงตามเงื่อนไขโจทย์ (1 คะแนน)</li>
                    <li>• หลักฐานภาพแคปภาพ Terminal แสดงผลลัพธ์ทั้งสองกรณี (ผ่าน/ไม่ผ่าน) ได้ครบถ้วน (1 คะแนน)</li>
                    <li>• จิตพิสัย ความตั้งใจ ความเป็นระเบียบของโค้ด และส่งงานตรงต่อเวลา (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>