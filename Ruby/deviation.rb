# frozen_string_literal: true

# ライブラリの指定
require 'csv'

# CSVファイルの読み込み
csv_data = CSV.read('成績.csv', headers: true)

# CSVファイルへのヘッダーの書き込み
CSV.open('偏差値.csv', 'a') do |test|
  test << ['氏名', '国語偏差値', '地理歴史偏差値', '公民偏差値', '外国語偏差値', '数学偏差値', '理科偏差値', '情報偏差値', '総合偏差値']
end

# 各総合点を計算して配列に格納するメソッド
def score(data, n)
	sum = 0
  (1..7).each do |i|
    sum += data[n][i].to_i
  end
  return sum
end

# 平均点を計算するメソッド
def average(data, n)
  sum = 0
  (0..50).each do |i|
    sum += data[i][n].to_i
  end
  avg = (sum / 51.to_f).round(0)
  return avg
end

# 標準偏差を計算するメソッド
def standard(data, n, avg)
  sum = 0
  (0..50).each do |i|
    sum += (data[i][n].to_i - avg)**2
  end
  stdev = (Math.sqrt(sum / 51.to_f)).round(0)
  return stdev
end

# 偏差値を計算するメソッド
def deviation(data, i, n, avg, stdev)
  dev = (((data[i][n].to_i - avg) * 10 / stdev .to_f) + 50 ).round(0)
  return dev
end

# 各教科の平均点と偏差値を計算
kokugo_avg = average(csv_data, 1)
kokugo_stdev = standard(csv_data, 1, kokugo_avg)
chireki_avg = average(csv_data, 2)
chireki_stdev = standard(csv_data, 2, chireki_avg)
koumin_avg = average(csv_data, 3)
koumin_stdev = standard(csv_data, 3, koumin_avg)
gaikokugo_avg = average(csv_data, 4)
gaikokugo_stdev = standard(csv_data, 4, gaikokugo_avg)
suugaku_avg = average(csv_data, 5)
suugaku_stdev = standard(csv_data, 5, suugaku_avg)
rika_avg = average(csv_data, 6)
rika_stdev = standard(csv_data, 6, rika_avg)
jouhou_avg = average(csv_data, 7)
jouhou_stdev = standard(csv_data, 7, jouhou_avg)

# 総合点の平均点
score = []
(0..50).each do |i|
  score[i] = score(csv_data, i)
end
score_avg = score.sum.fdiv(score.length).round(0)

# 総合点の標準偏差
sum = 0
(0..50).each do |i|
  sum += (score[i] - score_avg)**2
end
score_stdev = (Math.sqrt(sum / 51.to_f)).round(0)

# 全員の各教科と総合点の偏差値を求め、CSVファイルに書き込む
(0..50).each do |i|
  kokugo_dev = deviation(csv_data, i, 1, kokugo_avg, kokugo_stdev)
  chireki_dev = deviation(csv_data, i, 2, chireki_avg, chireki_stdev)
  koumin_dev = deviation(csv_data, i, 3, koumin_avg, koumin_stdev)
  gaikokugo_dev = deviation(csv_data, i, 4, gaikokugo_avg, gaikokugo_stdev)
  suugaku_dev = deviation(csv_data, i, 5, suugaku_avg, suugaku_stdev)
  rika_dev = deviation(csv_data, i, 6, rika_avg, rika_stdev)
  jouhou_dev = deviation(csv_data, i, 7, jouhou_avg, jouhou_stdev)
  score_dev = (((score[i] - score_avg) * 10 / score_stdev .to_f) + 50 ).round(0)
  CSV.open('偏差値.csv', 'a') do |test|
    test << [csv_data[i][0], kokugo_dev, chireki_dev, koumin_dev, gaikokugo_dev, suugaku_dev, rika_dev, jouhou_dev, score_dev]
  end
end