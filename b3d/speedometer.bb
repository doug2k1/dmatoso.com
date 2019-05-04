;///////////////////////////////////////////////////////////
;// Velocímetro com Sprite
;//
;//	por Douglas Matoso (Eric Draven): draven@rocknaveia.com
;///////////////////////////////////////////////////////////

Const GWID = 640	; largura da tela
Const GHEI = 480	; altura da tela

;// INICIALIZAÇÃO //////////////////////////////////////////

Graphics3D GWID, GHEI, 32, 2

; câmera
Local cam = CreateCamera()

; ponteiro do velocímetro (sprite)
; OBS1: Usamos o flag 3 (cor+alfa) para que a transparência
;	da imagem PNG seja respeitada.
; OBS2: O terceiro parâmetro indica que o sprite é entidade
;	filha da câmera (cam), portanto vai ficar fixo à ela.
Local pointer = LoadSprite("pointer.png",3,cam)
; redimensionamos e posicionamos o sprite
ScaleSprite pointer,256,256
PositionEntity pointer,-(GWID-256),-(GHEI-256),GWID

;-----------------------------------------------------------
; Dicas para posicionamentos e redimensionamento:
;
; 	Se o sprite for escalado com os mesmos valores da largura
; e altura da imagem e for posicionado a uma distância da 
; câmera igual à largura da tela, seu tamanho na tela será 
; exatamente o tamanho da imagem, independente da resolução
; da tela. Exemplo:
;
; 	Esta imagem (pointer.png) tem dimensões 256x256, então eu 
; usei:
;		ScaleSprite pointer, 256, 256
;		PositionEntity pointer, X, Y, GWID
;
; 	Onde GWID é a largura da tela. (X e Y veremos a seguir)
;
;	Para posicionar corretamente nos eixos X e Y, basta saber que:
;
;	Eixo X:
;		Extremidade esquerda:	-(largura da tela -  largura do sprite)
;		Meio da tela:			0
;		Extremidade direita:	largura da tela - largura do sprite
;
;	Para o eixo Y é a mesma coisa, apenas utilizando altura da tela
; e altura do sprite na conta. Exemplo:
;
;	Como eu queria posicionar o pointer no canto inferior esquerdo
; eu usei:
;		PositionEntity pointer, -(GWID-256), -(GHEI-256), GWID
;
; 	Se eu quisesse colocá-lo embaixo, mas no centro:
;		PositionEntity pointer, 0, -(GHEI-256), GWID
;-----------------------------------------------------------

Local speed# = 0		; "velocidade" (vai definir a rotação do sprite)
Local accel# = 2		; aceleração da rotação
Local desaccel# = 0.8	; desaceleração

;// LOOP PRINCIPAL /////////////////////////////////////////

While Not KeyHit(1)
	If KeyDown(200)		; se pressionada a tecla [CIMA]...
		; aumenta a velocidade
		speed = speed + accel
	ElseIf speed > 0	; senão, e se speed > 0...
		; diminua a velocidade
		speed = speed - desaccel
	ElseIf speed < 0	; se, por acaso, speed < 0
		; zere a velocidade
		speed = 0
	EndIf
	
	; rotacione o sprite
	RotateSprite pointer,-speed
	
	RenderWorld
	Text 10,10,"Aperte [CIMA] para mover o velocímetro"
	Flip
Wend

End