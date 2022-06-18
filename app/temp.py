# -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
"""
import requests
import cv2
import numpy as np # bu kütüphaneyi maskeleme için ekliyoruz
import imutils
import pytesseract # bu kütüphane resimdeki metni okuma için gerekli
#path= r'C:\Users\CELEP\OneDrive\Masaüstü\ASC DERSLER\Bitirme Projesi\licence_plate.jpg'
img = cv2.imread("D:\\silinecek\\licence_plate.jpg")
# bi yukarıdaki fonksiyon belirtilen yoldaki resmi imgnin içine atıyo
gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
filtered = cv2.bilateralFilter(gray,5,250,250)
"""
bilateralfilterdaki parametreler sırasıyla diameter, sigma color ve sigma space
diameter= filtrelemede piksellerin komşuluğunu belirleyen çap
sigma color= bu parametre arttıkça komşu piksellerdeki farklı renkler birbirleriyle
karışmaya başlar
sigma space= bu parametre arttıkça daha uzakta olan ve renk olarak birbirlerine yakın 
olan piksellerin birbirlerini etkilemesi artar
bu değerli deneme yanılma yoluyla belirlenecek. bu filtreyle plaka dışındaki yerleri
yumuşatıcaz ve plaka daha keskin ortaya çıkacak
"""
"""
edged1 = cv2.Canny(filtered,30,200) videoda adam bu değerleri vermiş ama benim 
verdiğim 30 500 değerleri çok daha iyi edged yaptı o yüzden şimdilik bir aşağıdaki 
canny kodunu kullanıyorum
"""
edged = cv2.Canny(filtered,30,400)

"""
cannydeki 30 ve 200 değerleri yoğunluk gradyanı eşiğinin minimum ve maksimum 
eşik değerleridir. canny matematiksel bir algoritmadır
"""
contoured = cv2.findContours(edged,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)
"""
findContours fonksiyonu filteredın içindeki kontorları belirtilen parametrelere göre 
bulcak. Tezde bu parametrelerden de bahset
"""
contours = imutils.grab_contours(contoured)
# bu fonksiyon ise bulunan kontorlardan uygun olanları seçer
contours = sorted(contours,key=cv2.contourArea,reverse=True)[:10]
#contours değerlerini alana göre ters olarak sırala ve bunu 0-10 arası değerler için yap 
screen = None #bulunan değer bunun içine atılacak

for c in contours:
    epsilon = 0.018*cv2.arcLength(c,True)
#arclength fonksiyonu kapalı bi kontorun çevresini hesaplar 
#epsilon bu algoritmanın doğruluğunu etkiler. tanımı tahmin edilen ile orijinal 
#alan arasındaki maksimum farktır
    approx = cv2.approxPolyDP(c,epsilon,True)
#bir çokgeni ondan daha az köşeli olan bir çokgenle belirtilmiş doğruluk değerinden
#küçük ya da eşit olacak şekilde karşılaştırır. True çokgen False eğri
    if len(approx) == 4: #eğer approxta 4 adet değer varsa yani bi dikdörtgen bulmuşsa
        screen= approx   #bu değerleri screenin içine at. screen 4 adet koordinat tutuyo
        break
mask= np.zeros(gray.shape,np.uint8)
#mask gray resmin boyutunda simsiyah bir pencere bunu orijinal resmin üzerine 
#koyucaz plaka hariç heryer siyah olacak

new_image = cv2.drawContours(mask,[screen],0,(255,255,255),-1)
#heryeri siyaha boyadı sonra belirtilen koordinatların içini beyaza boyadı
new_image = cv2.bitwise_and(img,img,mask=mask)
#bu kod beyaz olan yere plakayı yapıştıracak
(x,y)= np.where(mask==255)
#x,y koordinatına maskta beyaz olan yerleri at
#plaka kısmını kırpmak için dikdörtgenin iki köşesi lazım en sol üst ve en sağ alt 
#dikdörtgenin en solu ve en üstü bilgisayar tarafından orjin olarak alınır o halde
# en sol üstü bulmak için şu kod yazılır

(ensol_x,enüst_y)=(np.min(x),np.min(y))
#minimum olmasının sebebi bilgisayarın bu noktayı orjin olarak alması
(ensag_x,enalt_y)=(np.max(x),np.max(y))
cropped = gray[ensol_x:ensag_x+1,enüst_y:enalt_y+1]
plaka=pytesseract.image_to_string(cropped,lang="eng")
plaka = '8EGJ271'
json_data = {'data':plaka,'section':'B18'}
x = requests.post(url='http://localhost/otopark-projesi/control.php', json=json_data)

print(x.text)
print("plaka: ",plaka)




"""
cv2.imshow("plaka_orijinal",img)
cv2.imshow("plaka_gri",gray)
cv2.imshow("plaka_yumusatilmis",filtered)
cv2.imshow("plaka_edged-30-200",edged)
"""
# SONRADAN AC cv2.imshow("canny uygulanmis resim",edged)
# SONRADAN AC cv2.waitKey(0) 
#waitkeyin içindeki parametre milisaniye cinsinden açılan pencerenin ne kadar duracağını belirliyor
cv2.destroyAllWindows() 
"""
destroy fonksiyonnu yazılmazsa pencere asla kapanmayacak ve hata vericek. waitkeyin içine 
0 yazdık o da bir tuşa basılana kadar açık kalması basılınca kapanması demek. Kapatma 
işini destroy fonksiyonu yapıyo. İstersen waitkeyin içine saniye yaz destroy fonksiyonu 
olmazsa pencere kapanmaz
"""