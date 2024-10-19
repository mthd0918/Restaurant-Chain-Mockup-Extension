<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant Chains</title>
        <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Bundle JS (includes Popper) -->
        <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <div class="container mt-5">
            <h2 class="mb-4 text-center">Restaurant Chains Data Generator</h2>
            <form action="download.php" method="post">
                <!-- 従業員の数を選択 -->
                <div class="mb-3 fw-bold">
                    <label for="numberOfEmployee" class="form-label">Number of Employees:</label>
                    <input type="number" class="form-control" id="numberOfEmployee" name="numberOfEmployee" min="1" max="100" value="3">
                </div>
                <!-- 従業員の給与範囲を選択 -->
                <div class="mb-3 fw-bold">
                    <label for="salary" class="form-label">Salary Range:</label>
                    <select class="form-select" id="salary" name="salary">
                        <option value="20000">$20,000 - $49,999</option>
                        <option value="50000">$50,000 - $79,999</option>
                        <option value="80000">$80,000+</option>
                    </select>
                </div>
                <!-- チェーンの数を入力 -->
                <div class="mb-3 fw-bold">
                    <label for="numberOfLocation" class="form-label">Number of Locations:</label>
                    <input type="number" class="form-control" id="numberOfLocation" name="numberOfLocation" min="1" max="100" value="3">
                </div>
                <!-- 郵便番号の範囲を設定 -->
                <div class="mb-4">
                    <label class="form-label"><strong>Range of Postal Code:</strong></label>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="minPostalCode" class="form-label">Minimum Postal Code:</label>
                            <input type="text" class="form-control" id="minPostalCode" name="minPostalCode" 
                                pattern="[0-9]{3}-[0-9]{4}" placeholder="123-4567" required>
                        </div>
                        <div class="col-md-6">
                            <label for="maxPostalCode" class="form-label">Max Postal Code:</label>
                            <input type="text" class="form-control" id="maxPostalCode" name="maxPostalCode" 
                                pattern="[0-9]{3}-[0-9]{4}" placeholder="123-4567" required>
                        </div>
                    </div>
                </div>
                <!-- 生成したいファイルのタイプを選択 -->
                <div class="mb-3 fw-bold">
                    <label for="format" class="form-label">Download Format:</label>
                    <select class="form-select" id="format" name="format">
                        <option value="html">HTML</option>
                        <option value="markdown">Markdown</option>
                        <option value="json">JSON</option>
                        <option value="txt">Text</option>
                    </select>
                </div>
                <div class="text-center p-2">
                    <button type="submit" class="btn btn-primary btn-lg ">Generate</button>
                </div>
            </form>
        </div>
    </body>
</html>