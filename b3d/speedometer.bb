;///////////////////////////////////////////////////////////
;// Veloc�metro com Sprite
;//
;//	por Douglas Matoso (Eric Draven): draven@rocknaveia.com
;///////////////////////////////////////////////////////////

Const GWID = 640	; largura da tela
Const GHEI = 480	; altura da tela

;// INICIALIZA��O //////////////////////////////////////////

Graphics3D GWID, GHEI, 32, 2

; c�mera
Local cam = CreateCamera()

; ponteiro do veloc�metro (sprite)
; OBS1: Usamos o flag 3 (cor+alfa) para que a transpar�ncia
;	da imagem PNG seja respeitada.
; OBS2: O terceiro par�metro indica que o sprite � entidade
;	filha da c�mera (cam), portanto vai ficar fixo � ela.
Local pointer = LoadSprite("pointer.png",3,cam)
; redimensionamos e posicionamos o sprite
ScaleSprite pointer,256,256
PositionEntity pointer,-(GWID-256),-(GHEI-256),GWID

;-----------------------------------------------------------
; Dicas para posicionamentos e redimensionamento:
;
; 	Se o sprite for escalado com os mesmos valores da largura
; e altura da imagem e for posicionado a uma dist�ncia da 
; c�mera igual � largura da tela, seu tamanho na tela ser� 
; exatamente o tamanho da imagem, independente da resolu��o
; da tela. Exemplo:
;
; 	Esta imagem (pointer.png) tem dimens�es 256x256, ent�o eu 
; usei:
;		ScaleSprite pointer, 256, 256
;		PositionEntity pointer, X, Y, GWID
;
; 	Onde GWID � a largura da tela. (X e Y veremos a seguir)
;
;	Para posicionar corretamente nos eixos X e Y, basta saber que:
;
;	Eixo X:
;		Extremidade esquerda:	-(largura da tela -  largura do sprite)
;		Meio da tela:			0
;		Extremidade direita:	largura da tela - largura do sprite
;
;	Para o eixo Y � a mesma coisa, apenas utilizando altura da tela
; e altura do sprite na conta. Exemplo:
;
;	Como eu queria posicionar o pointer no canto inferior esquerdo
; eu usei:
;		PositionEntity pointer, -(GWID-256), -(GHEI-256), GWID
;
; 	Se eu quisesse coloc�-lo embaixo, mas no centro:
;		PositionEntity pointer, 0, -(GHEI-256), GWID
;-----------------------------------------------------------

Local speed# = 0		; "velocidade" (vai definir a rota��o do sprite)
Local accel# = 2		; acelera��o da rota��o
Local desaccel# = 0.8	; desacelera��o

;// LOOP PRINCIPAL /////////////////////////////////////////

While Not KeyHit(1)
	If KeyDown(200)		; se pressionada a tecla [CIMA]...
		; aumenta a velocidade
		speed = speed + accel
	ElseIf speed > 0	; sen�o, e se speed > 0...
		; diminua a velocidade
		speed = speed - desaccel
	ElseIf speed < 0	; se, por acaso, speed < 0
		; zere a velocidade
		speed = 0
	EndIf
	
	; rotacione o sprite
	RotateSprite pointer,-speed
	
	RenderWorld
	Text 10,10,"Aperte [CIMA] para mover o veloc�metro"
	Flip
Wend

End